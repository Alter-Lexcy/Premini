<?php

namespace App\Http\Controllers;

use App\Models\Artis;
use Illuminate\Http\Request;

class artisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artiss = Artis::all();
        return view('artis.index', compact('artiss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'artis' => 'required|string|max:255|unique:artis',
        ]);

        Artis::create($request->all());

        return redirect()->route('artis.index')
                         ->with('success', 'Artis created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artis $artis)
    {
        return view('artis.show', compact('artis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artis $artis)
    {
        return view('artis.edit', compact('artis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artis $artis)
    {
        $request->validate([
            'artis' => 'required|string|max:255|unique:artis,artis,' . $artis->id,
        ]);

        $artis->update($request->all());

        return redirect()->route('artis.index')
                         ->with('success', 'Artis updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artis $artis)
    {
        $artis->delete();

        return redirect()->route('artis.index')
                         ->with('success', 'Artis deleted successfully.');
    }
}
