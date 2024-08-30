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

        return view('artiss.index', compact('artiss'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('artiss.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'artis' => 'required|string|max:255',
        ]);

        Artis::create($request->all());


        return redirect()->route('artiss.index')
            ->with('success', 'Artis created successfully.');

    }

    /**
     * Display the specified resource.
     */

    public function show(Artis $artiss)
    {
        return view('artiss.show', compact('artiss'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Artis $artiss)
    {
        return view('artiss.edit', compact('artiss'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {

        // Temukan artis berdasarkan id
        $artis = Artis::findOrFail($id);

        // Validasi input
        $request->validate([
            'artis' => 'required|string|max:255',
        ]);

        // Update data artis
        $artis->update($request->all());

        // Redirect setelah berhasil update
        return redirect()->route('artiss.index')
            ->with('success', 'Artis updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Artis $artiss)
    {
        $artiss->delete();

        return redirect()->route('artiss.index')
            ->with('success', 'Artis deleted successfully.');

    }
}
