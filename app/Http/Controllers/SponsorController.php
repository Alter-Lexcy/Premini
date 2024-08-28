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
        return view('Sponsor.index',compact('data'));
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
        $request->validate([
            'nama_sponsor'=>'require|max:255|unique:sponsors,nama_sponsor,'
        ],[
            'nama_sponsor.require'=>'Nama Wajib Diisi',
            'nama_sponsor.unique'=>'Nama Sudah Ada'
        ]);

        Sponsor::create($request->all());
        return redirect()->route('Sponsor.index')->with('Berhasil','Data Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSponsorRequest $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }
}
