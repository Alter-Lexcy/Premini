<?php

namespace App\Http\Controllers;

use App\Models\attende;
use Illuminate\Http\Request;

class attendeController extends Controller
{
    
    public function index()
    {
        $attendees = Attende::all();
        return view('attendes.index', compact('attendes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attende.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:attendes',
            'phone' => 'required|numeric',
        ]);

        Attende::create($request->all());

        return redirect()->route('attende.index')
                         ->with('success', 'Attende created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attende $attende)
    {
        return view('attende.show', compact('attende'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attende $attende)
    {
        return view('attende.edit', compact('attende'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attende $attende)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:attendes,email,' . $attende->id,
            'phone' => 'required|numeric',
        ]);

        $attende->update($request->all());

        return redirect()->route('attende.index')
                         ->with('success', 'Attende updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attende $attende)
    {
        $attende->delete();

        return redirect()->route('attende.index')
                         ->with('success', 'Attende deleted successfully.');
    }
}
