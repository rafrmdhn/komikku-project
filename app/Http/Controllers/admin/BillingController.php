<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailPembelian;
use App\Models\Pembelian;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $billings = DetailPembelian::with('pembelian')->get();

        return view ('admin.billings.main', [
            'title' => 'Semua Tagihan',
            'billings' => $billings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $billing = Pembelian::find($id);

        return view('admin.billings.detail', compact('billing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelian $billing)
    {
        $validatedData = $request->validate([
            'status' => 'required'
        ]);

        Pembelian::where('id', $billing->id)
                ->update($validatedData);

        return redirect()->route('admin.billings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
