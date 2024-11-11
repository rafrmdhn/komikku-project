<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Komik;
use App\Models\Wishlist;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(Request $request){
        $totalCart = 0;

        if ($request->user()) {
            $totalCart = Cart::where('user_id', $request->user()->id)->count();
        }

        return view('home', [
            'komik_populer' => Komik::all(),
            'total_cart' => $totalCart,
        ]);
    }

    public function detail(Request $request, $id){
        $detailKomik = Komik::where('id', $id)->first();
        $totalCart = 0;

        if ($request->user()) {
            $totalCart = Cart::where('user_id', $request->user()->id)->count();
        }

        return view('detail', [
            'id' => $detailKomik->id,
            'nama_komik' => $detailKomik->title,
            'category' => $detailKomik->category->name,
            'deskripsi' => $detailKomik->description,
            'harga' => $detailKomik->price,
            'gambar' => $detailKomik->photo,
            'total_cart' => $totalCart,
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
        return view('cart', [
            'cart' => $cart,
            'total_cart' => Cart::where('user_id', $request->user()->id)->get()->count(),
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

        return redirect()->route('home');
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $totalPembayaran = 0;

        $lastPembelian = Pembelian::orderBy('id_pembelian', 'desc')->first();
        $currentIdPembelian = $lastPembelian ? $lastPembelian->id_pembelian + 1 : 1;

        foreach ($cartItems as $cartItem) {
            $komik = Komik::find($cartItem->komik_id);
            $itemTotalPembayaran = $komik->price * $cartItem->jumlah;
            $totalPembayaran += $itemTotalPembayaran;
        }

        foreach ($cartItems as $cartItem) {
            $komik = Komik::find($cartItem->komik_id);
            $itemTotalPembayaran = $komik->price * $cartItem->jumlah;
            
            Pembelian::create([
                'users_id' => Auth::id(),
                'komik_id' => $cartItem->komik_id,
                'jumlah_pembelian' => $cartItem->jumlah,
                'tanggal_pembelian' => now(),
                'total_pembayaran' => $itemTotalPembayaran,
                'status' => 'Proses',
                'bukti_tf' => null,
                'id_pembelian' => $currentIdPembelian,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('home')->with('success', 'Pembelian berhasil dilakukan');
    }

    public function payment(Request $request)
    {
        $totalCart = 0;

        if ($request->user()) {
            $totalCart = Cart::where('user_id', $request->user()->id)->count();
        }

        return view('payment', [
            'total_cart' => $totalCart,
        ]);
    }
}
