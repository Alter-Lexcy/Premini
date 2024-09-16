<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoadmapRequest;
use App\Http\Requests\UpdatetiketRequest;
use App\Models\event;
use App\Models\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoadmapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //membuat chard atau tampilan sesuai dengan event_id, jika ada data memiliki data yang sama maka membuat dalam satu tampilan
        $data = Roadmap::select('roadmaps.*')->whereIn('id', function ($query) {
            $query->selectRaw('MIN(id)')->from('roadmaps')->groupBy('event_id');
        })->get();

        return view('roadmap.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(event $event)
    {
        $dataEvent = event::all(); // menampilkan data event
        return view('roadmap.create', compact('event', 'dataEvent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'event_id' => 'required|unique:roadmaps,event_id',
            'roadmaps.*.jam_acara' => 'required|distinct', // lambang *  untuk array

            'roadmaps.*.deskripsi_acara' => 'required|string|distinct', // lambang *  untuk array
        ], [
            'event_id.required' => 'Event harus diisi',
            'event_id.unique' => 'Event sudah ada',
            'roadmaps.*.jam_acara.required' => 'Jam acara belum diisi',
            'roadmaps.*.jam_acara.distinct' => 'Jam acara tidak boleh duplikat',
            'roadmaps.*.deskripsi_acara.required' => 'Deskripsi acara belum diisi',
            'roadmaps.*.deskripsi_acara.string' => 'Format deskripsi acara tidak sesuai',
            'roadmaps.*.deskripsi_acara.distinct' => 'Deskripsi acara tidak boleh duplikat',
        ]);

        // dd('Validation passed');
        foreach ($request->roadmaps as $roadmapData) {
            Roadmap::create([
                'event_id' => $request->event_id, // Hanya ambil dari input sekali
                'jam_acara' => $roadmapData['jam_acara'], // mengambil dan membuat data dari multi-from
                'deskripsi_acara' => $roadmapData['deskripsi_acara'], // mengambil dan membuat data dari multi-from
            ]);
        }

        return redirect()->route('roadmap.index')->with('success', 'Roadmap berhasil dibuat');
    }


    /**
     * Display the specified resource.
     */
    public function show(Roadmap $roadmap)
    {
        $roadmaps = Roadmap::where('event_id', $roadmap->event_id)->orderBy('jam_acara', 'asc')->get(); //menampilakan sesuai dengan event_id dan diurutkan sesuai dengan jam_acara
        return view('roadmap.show', compact('roadmap', 'roadmaps'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roadmap = Roadmap::find($id);
        $roadmaps = $roadmap->where('event_id', $roadmap->event_id)->get(); //mengambil data roadmap yang berelasi dengan event
        $dataEvent = Event::all(); //menampilkan data event
        $event = $roadmap->event; //data yang beralsi
        return view('roadmap.update', compact('roadmap', 'roadmaps', 'dataEvent', 'event'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'roadmaps.*.jam_acara' => 'required',
            'distinct', // lambang *  untuk array
            'roadmaps.*.deskripsi_acara' => 'required',
            'distinct', // lambang *  untuk array
        ], [
            'roadmaps.*.jam_acara.required' => 'Jam Acara Belum di-isi',
            'roadmaps.*.jam_acara.distinct' => 'Jam Acara Sudah Ada di inputan sebelumnya',
            'roadmaps.*.deskripsi_acara.required' => 'Deskripsi Belum Di-isi',
            'roadmaps.*.deskripsi_acara.distinct' => 'Deskripsi Sudah Ada di input',
        ]);

        $event = Event::findOrFail($id); // Temukan event berdasarkan ID
        $event->update(['event_id' => $request->event_id]); // Update informasi event
        Roadmap::where('event_id', $event->id)->delete(); // Hapus roadmap yang lama

        // Simpan roadmap yang baru
        foreach ($request->roadmaps as $roadmap) {
            Roadmap::create([
                'event_id' => $event->id,
                'jam_acara' => $roadmap['jam_acara'],
                'deskripsi_acara' => $roadmap['deskripsi_acara'],
            ]);
        }

        return redirect()->route('roadmap.index')->with('success', 'Roadmap berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roadmap $roadmap)
    {
        Roadmap::where('event_id', $roadmap->event_id)->delete(); //menghapus semua data ketika memiliki data event_id yang sama
        return redirect()->route('roadmap.index')->with('Berhasil', 'Data Berhasil Dihapus');
    }
}
