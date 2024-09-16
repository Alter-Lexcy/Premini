<?php

namespace App\Http\Controllers;

use App\Models\artis;
use App\Models\event;
use App\Models\venue;
use App\Models\Sponsor;
use App\Models\Categori;
use App\Models\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $data = event::whereHas('category', function ($query) use ($search) {
            $query->where('categori', 'LIKE', '%' . $search . '%');
        })->orWhere('nama_event', 'LIKE', '%' . $search . '%')->get();

        return view('event.index', compact('data', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sponsor = Sponsor::all();
        $artis = artis::all();
        $venue = venue::all();
        $category = Categori::all();

        return view('event.create', compact('sponsor', 'artis', 'venue', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required',
            'nama_event' => 'required|max:255|unique:events,nama_event',
            'mulai' => 'required|date',
            'berakhir' => 'required|date|after:mulai',
            'sponsor_id' => 'required',
            'sponsor_id.*' => 'exists:sponsors,id',
            'artis_id' => 'required',
            'artis_id.*' => 'exists:artiss,id',
            'venue_id' => 'required',
            'categori_id' => 'required',
            'stok' => 'required|numeric|min:0',
        ], [
            'foto.required' => 'Foto belum diisi',
            'nama_event.required' => 'Nama event Belum diisi',
            'nama_event.unique' => 'Nama event sudah ada',
            'mulai.required' => 'Tanggal Mulai Belum Diisi',
            'berakhir.required' => 'Tanggal Berakhir Belum Diisi',
            'berakhir.after' => 'Tanggal Berakhir Harus sesudah Tanggal Mulai',
            'sponsor_id.required' => 'Sponsor Belum Diisi',
            'artis_id.required' => 'Artis Belum Diisi',
            'venue_id.required' => 'Pemilik Event Belum Diisi',
            'categori_id.required' => 'Kategori Event Belum Diisi',
            'stok.required' => 'Stok Belum Diisi',
            'stok.min' => 'Stok tidak bisa dibawah 0',
        ]);

        // dd($request);
        $img = $request->foto->store('poster', 'public');
        $event =  event::create([
            'foto' => $img,
            'nama_event' => $request->nama_event,
            'mulai' => $request->mulai,
            'berakhir' => $request->berakhir,
            'venue_id' => $request->venue_id,
            'categori_id' => $request->categori_id,
            'stok' => $request->stok
        ]);

        $event->sponsor()->attach($request->sponsor_id);
        $event->artis()->attach($request->artis_id);
        return redirect()->route('event.index')->with('Berhasil', 'Data berhasil Di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(event $event)
    {
        // dd($event->category->categori);
        $dataroadmap = Roadmap::all();
        $roadmap = $event->roadmap;
        return view('event.show', compact('event','roadmap','dataroadmap'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(event $event)
    {
        $sponsorTerpilih = $event->sponsor()->pluck('sponsors.id')->toArray();
        $artisTerpilih = $event->artis()->pluck('artiss.id')->toArray();
        $sponsor = Sponsor::all();
        $artis = artis::all();
        $venue = venue::all();
        $category = Categori::all();

        return view('event.update', compact('event', 'sponsor', 'artis', 'venue', 'category','sponsorTerpilih','artisTerpilih'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($event->foto) {
                Storage::disk('public')->delete($event->foto);
            }

            $img = $request->foto->store('poster', 'public');
            $event->foto = $img;
        }

        $event->nama_event = $request->nama_event;
        $event->mulai = $request->mulai;
        $event->berakhir = $request->berakhir;
        $event->venue_id = $request->venue_id;
        $event->categori_id = $request->categori_id;
        $event->stok = $request->stok;

        // Simpan perubahan
        $event->save();

        $event->sponsor()->sync($request->sponsor_id);
        $event->artis()->sync($request->artis_id);

        // Redirect atau respons setelah update berhasil
        return redirect()->route('event.index')->with('Berhasil', 'Event berhasil Diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(event $event)
    {
        try {
            $filename = $event->foto;
            $event->delete();
            Storage::disk('public')->delete($filename);
            return redirect()->route('event.index')->with('Berhasil', 'Data Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors('Data Tidak Bisa Di hapus Karena Masih Berelasi');
        }
    }
}
