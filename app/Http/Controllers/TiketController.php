<?php

namespace App\Http\Controllers;

use App\Models\tiket;
use App\Http\Requests\StoretiketRequest;
use App\Http\Requests\UpdatetiketRequest;
use App\Models\Attende;
use App\Models\event;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = tiket::all();
        return view('tiket.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peserta = Attende::all();
        $event = event::all();
        return view('tiket.create',compact('peserta','event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretiketRequest $request)
    {
        $request->validate([
            'Nama_id' => 'required',
            'event_id' => 'required',
            'jumlah_tiket' => 'required|numeric|min:1',
        ], [
            'Nama_id.required' => 'Peserta belum Diisi',
            'event_id.required' => 'Event Belum Diisi',
            'jumlah_tiket.required' => 'Jumlah Tiket Belum diisi',
            'jumlah_tiket.min' => 'Jumlah Tiket Tidak Bisa Mines',
        ]);

        // Ambil data event berdasarkan event_id
        $event = Event::findOrFail($request->event_id);

        // Cek apakah stok mencukupi
        if ($event->stok < $request->jumlah_tiket) {
            return back()->withErrors(['message' => 'Stok tiket tidak mencukupi']);
        }

        // Kurangi stok
        $event->stok -= $request->jumlah_tiket;
        $event->save();

        // Simpan data tiket
        Tiket::create($request->all());

        return redirect()->route('tiket.index')->with('Berhasil', 'Data Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(tiket $tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tiket $tiket)
    {
        $peserta = Attende::all();
        $event = event::all();
        return view('tiket.update',compact('tiket','peserta','event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetiketRequest $request, tiket $tiket)
    {
        $request->validate([
            'Nama_id'=>['required'],
            'event_id'=>['required'],
            'jumlah_tiket'=>['required','numeric','min:1'],
        ],[
            'Nama_id.required'=>'Peserta belum Diisi',
            'event_id.required'=>'Event Belum Diisi',
            'jumlah_tiket.required'=>'Jumlah Tiket Belum diisi',
            'jumlah_tiket.min'=>'Jumlah Tiket Tidak Bisa Mines'
        ]);

        $eventLama = Event::findOrFail($tiket->event_id);
        $eventBaru = Event::findOrFail($request->event_id);

        // Jika event_id berubah, kembalikan stok event lama
        if ($eventLama->id !== $eventBaru->id) {
            $eventLama->stok += $tiket->jumlah_tiket;
            $eventLama->save();

            // Kurangi stok event baru
            if ($eventBaru->stok < $request->jumlah_tiket) {
                return back()->withErrors(['message' => 'Stok tiket tidak mencukupi']);
            }

            $eventBaru->stok -= $request->jumlah_tiket;
            $eventBaru->save();
        } else {
            // Jika event_id sama, update stok sesuai dengan perubahan jumlah_tiket
            $stokSelisih = $request->jumlah_tiket - $tiket->jumlah_tiket;

            if ($eventLama->stok < $stokSelisih) {
                return back()->withErrors(['message' => 'Stok tiket tidak mencukupi']);
            }

            $eventLama->stok -= $stokSelisih;
            $eventLama->save();
        }

        $tiket->update($request->all());
        return redirect()->route('tiket.index')->with('Berhasil','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
 * Remove the specified resource from storage.
 */
public function destroy(tiket $tiket)
{
    // Ambil event terkait tiket
    $event = Event::findOrFail($tiket->event_id);

    // Kembalikan stok tiket ke event terkait
    $event->stok += $tiket->jumlah_tiket;
    $event->save();

    // Hapus tiket
    $tiket->delete();

    return redirect()->route('tiket.index')->with('Berhasil', 'Pesanan berhasil dibatalkan, dan stok tiket telah dikembalikan.');
}

}
