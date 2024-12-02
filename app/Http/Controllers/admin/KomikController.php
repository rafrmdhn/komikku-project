<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Komik;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class KomikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        $komiks = Komik::all();

        return view('admin.komik.main', [
            'title' => 'Semua Komik',
            'komiks' => $komiks,
            'categories' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.komik.create', [
            'title' => 'Tambah Komiik',
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'publication_year' => 'required',
            'stock' => 'required',
            'isbn' => 'required',
            'description' => 'required',
            'price' => 'required',
            'link_komik' => 'required',
            'photo' => 'image|file|max:2048',
        ]);

        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/komik');
        }        

        $validatedData['publication_year'] = $validatedData['publication_year'] . '-01';

        Komik::create($validatedData);

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $komik = Komik::findOrFail($id);
        $category = Category::all();

        return view('admin.komik.edit', [
            'title' => 'Edit Komik',
            'komik' => $komik,
            'categories' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $komik = Komik::findOrFail($id);
        
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required', 
            'category_id' => 'required',
            'publication_year' => 'required',
            'stock' => 'required',
            'isbn' => 'required',
            'description' => 'required',
            'price' => 'required',
            'link_komik' => 'required',
            'photo' => 'image|file|max:2048',
        ]);

        if ($request->file('photo')) {
            if ($komik->photo && Storage::exists($komik->photo)) {
                Storage::delete($komik->photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('images/komik');
        }

        $validatedData['publication_year'] = $validatedData['publication_year'] . '-01';

        $komik->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Data telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $komik = Komik::findOrFail($id);
        $komik->delete();
    
        return redirect()->route('admin.products.index')->with('success', 'Komik deleted successfully.');
    }
}
