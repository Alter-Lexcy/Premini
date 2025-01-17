<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Http\Requests\StoreSponsorRequest;
use App\Http\Requests\UpdateSponsorRequest;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sponsor::all();
        return view('Sponsor.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Sponsor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSponsorRequest $request)
    {
        Sponsor::create($request->all());
        return redirect()->route('sponsors.index')->with('Berhasil', 'Data Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        return view('Sponsor.view',compact('sponsor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        return view('Sponsor.update', compact('sponsor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSponsorRequest $request, Sponsor $sponsor)
    {
        $sponsor->update($request->all());
        return redirect()->route('sponsors.index')->with('Berhasil','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $sponsor = Sponsor::findOrFail($id);
            $sponsor->delete();
            return redirect()->route('sponsors.index')->with('Berhasil', 'Data berhasil dihapus!');
        } catch (\illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors('Data Tidak bisa dihapus karena masih berelasi');
        }
    }
}
