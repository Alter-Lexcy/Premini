<?php

namespace App\Http\Controllers;

use App\Models\katagory;
use Illuminate\Http\Request;

class katagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $katagoryes = katagory::all();
        return view('katagory.index', compact('katagoryes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('katagory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'katagory' => 'required|string|max:255|unique:katagory',
        ]);

        Katagory::create($request->all());

        return redirect()->route('katagory.index')
                         ->with('success', 'Katagory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Katagory $katagory)
    {
        return view('katagory.show', compact('katagory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Katagory $katagory)
    {
        return view('katagory.edit', compact('katagory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Katagory $katagory)
    {
        $request->validate([
            'katagory' => 'required|string|max:255|unique:katagory,katagory,' . $katagory->id,
        ]);

        $katagory->update($request->all());

        return redirect()->route('katagory.index')
                         ->with('success', 'Katagory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Katagory $katagory)
    {
        $katagory->delete();

        return redirect()->route('katagory.index')
                         ->with('success', 'Katagory deleted successfully.');
    }
}
