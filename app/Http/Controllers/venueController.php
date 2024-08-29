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
        return view('venue.index', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venue.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NamaPembuatEvent' => 'required|string|max:255',
        ]);

        Venue::create($request->all());

        return redirect()->route('venues.index')
                         ->with('success', 'Venue created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        return view('venue.show', compact('venue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {
        return view('venue.edit', compact('venue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        $request->validate([
            'NamaPembuatEvent' => 'required|string|max:255',
        ]);

        $venue->update($request->all());

        return redirect()->route('venues.index')
                         ->with('success', 'Venue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();

        return redirect()->route('venues.index')
                         ->with('success', 'Venue deleted successfully.');
    }
}
