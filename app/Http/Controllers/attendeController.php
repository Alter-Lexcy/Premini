<?php
namespace App\Http\Controllers;

use App\Models\Attende;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class attendeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendes = Attende::all();
        return view('attendes.index', compact('attendes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attendes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:attendes,email',
            'phone' => 'required|numeric|unique:attendes,phone',
        ], [
            'nama.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.required' => 'Nomor HP tidak boleh kosong.',
            'phone.numeric' => 'Nomor HP tidak boleh menggunakan huruf.',
            'phone.unique' => 'Nomor HP sudah terdaftar.',
        ]);

        Attende::create($request->all());

        return redirect()->route('attendes.index')
                         ->with('success', 'peserta berhasil di buat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attende $attende)
    {
        return view('attendes.show', compact('attende'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attende $attende)
    {
        return view('attendes.edit', compact('attende'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Attende $attende)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('attendes', 'email')->ignore($attende->id),
            ],
            'phone' => [
                'required',
                'numeric',
                Rule::unique('attendes', 'phone')->ignore($attende->id),
            ],
        ], [
            'nama.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.required' => 'Nomor HP tidak boleh kosong.',
            'phone.numeric' => 'Nomor HP tidak boleh menggunakan huruf.',
            'phone.unique' => 'Nomor HP sudah terdaftar.',
        ]);
    
        $attende->update($request->all());
    
        return redirect()->route('attendes.index')
                         ->with('success', 'Peserta berhasil diupdate.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attende $attende)
{
    try {
        $attende->delete();
        return redirect()->route('attendes.index')
                         ->with('success', 'Peserta berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('attendes.index')
                         ->with('error', 'Gagal menghapus Peserta . Pastikan Peserta  tidak terkait dengan data lain.');
    }
}

}
