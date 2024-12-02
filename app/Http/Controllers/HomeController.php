<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Komik;
use App\Models\Category;
use App\Models\DetailPembelian;
use App\Models\Wishlist;
use App\Models\Pembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(Request $request, $id = null){
        $totalCart = 0;
        $wishlistKomikIds  = [];

        if ($request->user()) {
            $totalCart = Cart::where('user_id', $request->user()->id)->count();
            $wishlistKomikIds  = Wishlist::where('user_id', $request->user()->id)
                ->pluck('komik_id')
                ->toArray();
        }

        return view('home', [
            'komik_populer' => Komik::limit(7)->get(),
            'total_cart' => $totalCart,
            'recommends' => Komik::orderBy('publication_year', 'desc')->limit(4)->get(),
            'wishlistKomikIds' => $wishlistKomikIds,
        ]);
    }

    public function detail(Request $request, $id){
        $detailKomik = Komik::where('id', $id)->first();
        $totalCart = 0;
        $isInWishlist = false;
        $wishlistKomikIds  = [];

        if ($request->user()) {
            $totalCart = Cart::where('user_id', $request->user()->id)->count();
            $isInWishlist = Wishlist::where('user_id', $request->user()->id)
                ->where('komik_id', $id)
                ->exists();
            $wishlistKomikIds  = Wishlist::where('user_id', $request->user()->id)
                ->pluck('komik_id')
                ->toArray();
        }

        $recommend_komiks = Komik::where('category_id', $detailKomik->category_id)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();

        return view('detail', [
            'id' => $detailKomik->id,
            'nama_komik' => $detailKomik->title,
            'category' => $detailKomik->category->name,
            'deskripsi' => $detailKomik->description,
            'harga' => $detailKomik->price,
            'gambar' => $detailKomik->photo,
            'total_cart' => $totalCart,
            'isInWishlist' => $isInWishlist,
            'recommend_komiks' => $recommend_komiks,
            'wishlistKomikIds' => $wishlistKomikIds,
        ]);
    }

    public function addCart(Request $request)
    {
        $komik_id = $request->input('komik_id');
        $quantity = (int) $request->input('jumlah');

        $cartItem = Cart::where('user_id', $request->user()->id)
                        ->where('komik_id', $komik_id)
                        ->first();

        if ($cartItem) {
            $cartItem->jumlah += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $request->user()->id,
                'komik_id' => $komik_id,
                'jumlah' => $quantity,
            ]);
        }

        return redirect()->route('cart');
    }

    public function updateQuantity(Request $request, $id)
    {
        $cart = Cart::find($id);
        
        if ($cart) {
            $cart->jumlah = (int) $request->input('jumlah');
            $cart->save();
            
            $carts = Cart::with('komik')->where('user_id', $request->user()->id)->get();
            return response()->json([
                'new_quantity' => $cart->jumlah,
                'new_total_price' => number_format($carts->sum(function($item) {
                            return $item->komik->price * $item->jumlah;
                        }), 0, ',', '.')
            ]);
        }
    
        return response()->json(['error' => 'Item not found'], 404);
    }

    public function cart(Request $request){
        $cart = Cart::with('komik')->where('user_id', $request->user()->id)->get();
        $wishlistItems = Wishlist::where('user_id', $request->user()->id)->pluck('komik_id')->toArray();
        $wishlistKomikIds = [];

        $wishlistKomikIds = Wishlist::where('user_id', $request->user()->id)
            ->pluck('komik_id')
            ->toArray();

        return view('cart', [
            'cart' => $cart,
            'total_cart' => Cart::where('user_id', $request->user()->id)->get()->count(),
            'wishlistItems' => $wishlistItems,
            'komiks' => Komik::inRandomOrder()->limit(3)->get(),
            'wishlistKomikIds' => $wishlistKomikIds,
        ]);
    }

    public function cartDestroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
    
        return redirect()->route('cart');
    }

    public function addWishlist(Request $request)
    {
        $komik_id = $request->input('komik_id');

        Wishlist::create([
            'user_id' => $request->user()->id,
            'komik_id' => $komik_id,
        ]);

        return redirect()->to(url()->previous())->with('status', 'Komik berhasil ditambahkan ke wishlist');
    }

    public function removeWishlist(Request $request)
    {
        $komik_id = $request->input('komik_id');

        Wishlist::where('user_id', $request->user()->id)
            ->where('komik_id', $komik_id)
            ->delete();
        
        return redirect()->to(url()->previous())->with('status', 'Komik berhasil dihapus dari wishlist');
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $totalPembayaran = 0;

        $lastPembelian = Pembelian::orderBy('id', 'desc')->first();
        $currentInvoiceNumber = $lastPembelian
            ? 'INV/' . Carbon::now()->format('Ymd') . '/KMK/' . ($lastPembelian->id + 1)
            : 'INV/' . Carbon::now()->format('Ymd') . '/KMK/1';

        foreach ($cartItems as $cartItem) {
            $komik = Komik::find($cartItem->komik_id);
            $itemTotalPembayaran = $komik->price * $cartItem->jumlah;
            $totalPembayaran += $itemTotalPembayaran;
        }

        $pembelian = Pembelian::create([
            'users_id' => Auth::id(),
            'tanggal_pembelian' => now(),
            'total_pembayaran' => $totalPembayaran,
            'status' => 'Proses',
            'bukti_tf' => null,
            'invoice_number' => $currentInvoiceNumber,
        ]);

        foreach ($cartItems as $cartItem) {
            $komik = Komik::find($cartItem->komik_id);

            if ($komik->stock < $cartItem->jumlah) {
                return back()->with('error', "Stok untuk komik {$komik->title} tidak mencukupi.");
            }

            DetailPembelian::create([
                'pembelian_id' => $pembelian->id,
                'komik_id' => $cartItem->komik_id,
                'jumlah' => $cartItem->jumlah
            ]);

            $komik->stock -= $cartItem->jumlah;
            $komik->save();
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('payment', ['id' => $pembelian->id]);
    }

    public function payment(Request $request, $id)
    {
        $pembelian = Pembelian::with('detail_pembelians')->where('id', $id)->first();

        if (!$pembelian) {
            return redirect()->route('home')->with('error', 'Pembayaran tidak ditemukan atau sudah selesai.');
        }

        $totalCart = Cart::where('user_id', $request->user()->id)->count();

        return view('payment', [
            'total_cart' => $totalCart,
            'id_pembelian' => $id,
            'total_harga' => $pembelian->total_pembayaran,
        ]);
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'bukti_tf' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
        ]);

        if ($request->hasFile('bukti_tf')) {
            $file = $request->file('bukti_tf');
            $filePath = $file->store('images/bukti_tf', 'public');

            Pembelian::where('id', $request->id)->update([
                'status' => 'Menunggu Verifikasi',
                'bukti_tf' => $filePath,
            ]);

            return redirect()->route('home')->with('status', 'Pembayaran berhasil, tunggu verifikasi.');
        }

        return back()->with('status', 'Terjadi kesalahan saat mengunggah bukti pembayaran.');
    }

    public function listKomik(Request $request)
    {
        $totalCart = 0;

        if ($request->user()) {
            $totalCart = Cart::where('user_id', $request->user()->id)->count();
        }

        $query = Komik::query();

        if ($request->has('kategori') && $request->kategori) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->kategori);
            });
        }
        
        $data = [
            'total_cart' => $totalCart,
            'komiks' => $query->orderBy('title', 'asc')->paginate(10),
            'categories' => Category::all(),
        ];

        return view('list', $data);
    }

    public function search(Request $request)
    {
        $totalCart = 0;
        if ($request->user()) {
            $totalCart = Cart::where('user_id', $request->user()->id)->count();
        }

        $search = $request->get('search');
        $komiks = Komik::where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%') 
                    ->paginate(10)
                    ->appends(['search' => $search]);
        
        return view('list', [
            'komiks' => $komiks,
            'search' => $search,
            'total_cart' => $totalCart,
            'categories' => Category::all(),
        ]);
    }

    public function orderList(Request $request)
    {
        $totalCart = 0;
        $wishlistKomikIds  = [];

        if ($request->user()) {
            $totalCart = Cart::where('user_id', $request->user()->id)->count();
            $orders =  Pembelian::with('user', 'detail_pembelians')
            ->where('users_id', $request->user()->id )
            ->get();
            $wishlistKomikIds  = Wishlist::where('user_id', $request->user()->id)
                ->pluck('komik_id')
                ->toArray();
        }

        if (!$request->session()->has('random_recommends')) {
            $randomKomik = Komik::inRandomOrder()->take(4)->get();
            $request->session()->put('random_recommends', $randomKomik);
        } else {
            $randomKomik = $request->session()->get('random_recommends');
        }

        return view('orderlist', [
            'total_cart' => $totalCart,
            'orders' => $orders,
            'wishlistKomikIds' => $wishlistKomikIds,
            'recommends' => $randomKomik,
        ]);
    }

    public function newestList(Request $request)
    {
        $totalCart = 0;

        if ($request->user()) {
            $totalCart = Cart::where('user_id', $request->user()->id)->count();
        }

        return view('newest', [
            'total_cart' => $totalCart,
            'komiks' => Komik::orderBy('created_at', 'desc')->take(15)->get(),
        ]);
    }

    public function wishList(Request $request)
    {
        $totalCart = 0;

        if ($request->user()) {
            $totalCart = Cart::where('user_id', $request->user()->id)->count();
        }

        $wishlistItems = Wishlist::where('user_id', $request->user()->id)
            ->with('komik') 
            ->get();

        return view('wishlist', [
            'total_cart' => $totalCart,
            'wishlists' => $wishlistItems,
        ]);
    }

    public function cancelOrder(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:pembelians,id'
        ]);

        $order = Pembelian::find($request->id);

        if ($order->status === 'Selesai') {
            return redirect()->back()->with('status', 'Pesanan sudah selesai dan tidak dapat dibatalkan.');
        }

        $order->status = 'Pengajuan Batal';
        $order->save();

        return redirect()->back()->with('status', 'Pengajuan pembatalan berhasil dilakukan.');
    }
}
