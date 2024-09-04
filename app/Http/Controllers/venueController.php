<?php


namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class venueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
    {
        $venues = Venue::all();

        return view('venues.index', compact('venues'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('venues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NamaPembuatEvent' => 'required|string|max:255',
        ], [
            'NamaPembuatEvent.required' => 'Kolom pemilik tidak boleh kosong.',
        ]);

        Venue::create($request->all());

        return redirect()->route('venues.index')
                         ->with('success', 'pemilik berhasil di buat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {

        return view('venues.show', compact('venue'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {

        return view('venues.edit', compact('venue'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        $request->validate([
            'NamaPembuatEvent' => 'required|string|max:255',
        ], [
            'NamaPembuatEvent.required' => 'Kolom pemilik tidak boleh kosong.',
        ]);

        $venue->update($request->all());

        return redirect()->route('venues.index')
                         ->with('success', 'pemilik berhasil di perbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
{
    try {
        $venue->delete();

        return redirect()->route('venues.index')
                         ->with('success', 'Pemilik berhasil dihapus.');
     } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors('Data Tidak Bisa Di hapus Karena Masih Berelasi');
        }
}

}
