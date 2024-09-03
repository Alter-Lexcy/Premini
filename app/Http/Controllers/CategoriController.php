<?php
namespace App\Http\Controllers;

use App\Models\Categori;
use Illuminate\Http\Request;

class CategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoris = Categori::all();
        return view('categoris.index', compact('categoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categori' => 'required|string|max:255|unique:categoris,categori',
        ], [
            'categori.required' => 'Kolom kategori tidak boleh kosong.',
            'categori.unique' => 'Kategori ini sudah ada.',
        ]);

        Categori::create($request->all());

        return redirect()->route('categoris.index')
                         ->with('success', 'kategori berhasil di buat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categori $categori)
    {
        return view('categoris.show', compact('categori'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categori $categori)
    {
        return view('categoris.edit', compact('categori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categori $categori)
    {
        $request->validate([
            'categori' => 'required|string|max:255|unique:categoris,categori',
        ], [
            'categori.required' => 'Kolom kategori tidak boleh kosong.',
            'categori.unique' => 'Kategori ini sudah ada.',
        ]);

        $categori->update($request->all());

        return redirect()->route('categoris.index')
                         ->with('success', 'kategori berhasil di update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categori $categori)
{
    try {
        $categori->delete();
        return redirect()->route('categoris.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('categoris.index')
                         ->with('error', 'Gagal menghapus kategori. Pastikan kategori tidak terkait dengan data lain.');
    }
}

}

