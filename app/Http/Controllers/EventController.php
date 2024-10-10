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
        // mendapatkan data dari form search melalui request dan di simpan di Variable $seacrh
        $search = $request->input('search');

        //$data berisi perintah searching yang dimana tampilan nya akan muncul ketika user mencari sesuai dengan ketentuannya (Kategori dan nama)
        $data = event::with(['category', 'artis', 'sponsor', 'venue'])->whereHas('category', function ($query) use ($search) {
            $query->where('categori', 'LIKE', '%' . $search . '%');
        })->orWhere('nama_event', 'LIKE', '%' . $search . '%')->paginate(3); // paginate berfungsi untuk membuat halaman atau page baru ketika sudah melebihi limit index

        return view('event.index', compact('data', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sponsor = Sponsor::all(); // memanggil Data Sponsor
        $artis = artis::all(); // memanggil Data Artis
        $venue = venue::all(); // memanggil Data Venue
        $category = Categori::all(); // memanggil Data Categori

        return view('event.create', compact('sponsor', 'artis', 'venue', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // membuat validasi (pengecek-an)
        $request->validate([
            'foto' => 'required',
            'nama_event' => 'required|max:255|unique:events,nama_event',
            'mulai' => 'required|date',
            'berakhir' => 'required|date|after:mulai',
            'sponsor_id' => 'required',
            'sponsor_id.*' => 'exists:sponsors,id', // * untuk data yang ber-array
            'artis_id' => 'required',
            'artis_id.*' => 'exists:artiss,id', // * untuk data yang ber-array
            'venue_id' => 'required',
            'categori_id' => 'required',
            'stok' => 'required|numeric|min:0',
        ], [
            // untuk messange jika ada yang salah atau messange untuk validasinya
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
        $img = $request->foto->store('poster', 'public'); // berisi perintah ketika user sudah menambahkan file gambar, filenya akan tersimpan pada folder poster yang berada didalam folder public
        // $event berisi tentang perintah untuk membuat data, sebelum membuat data sesuai dengan inputan user akan dicek terlebih dahulu oleh request (validasi)
        $event =  event::create([
            'foto' => $img,
            'nama_event' => $request->nama_event,
            'mulai' => $request->mulai,
            'berakhir' => $request->berakhir,
            'venue_id' => $request->venue_id,
            'categori_id' => $request->categori_id,
            'stok' => $request->stok
        ]);


        $event->sponsor()->attach($request->sponsor_id); // menambahkan data sponsor ke dalam tabel pivot EventSponsor
        $event->artis()->attach($request->artis_id); // menambahkan data artis ke dalam tabel pivot EventArtis
        return redirect()->route('event.index')->with('Berhasil', 'Data berhasil Di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(event $event)
    {
        // dd($event->category->categori);
        $dataroadmap = Roadmap::all(); // menampilkan data Roadmap
        $roadmap = $event->roadmap;
        return view('event.show', compact('event','roadmap','dataroadmap'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(event $event)
    {
        $sponsorTerpilih = $event->sponsor()->pluck('sponsors.id')->toArray(); // mengambil data dari pivot dengan format array
        $artisTerpilih = $event->artis()->pluck('artiss.id')->toArray(); // mengambil data dari pivot dengan format array
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
        // mencari dulu id-nya
        $event = Event::findOrFail($id);

        // mengambil data foto
        if ($request->hasFile('foto')) {
            // jika foto ada data-nya maka nanti akan dihapus
            if ($event->foto) {
                Storage::disk('public')->delete($event->foto);
            }
            // setelah hapus akan digantikan dengan yang baru
            $img = $request->foto->store('poster', 'public');
            $event->foto = $img;
        }
        //  mengupdate data event
        $event->nama_event = $request->nama_event;
        $event->mulai = $request->mulai;
        $event->berakhir = $request->berakhir;
        $event->venue_id = $request->venue_id;
        $event->categori_id = $request->categori_id;
        $event->stok = $request->stok;

        // Simpan perubahan
        $event->save();

        $event->sponsor()->sync($request->sponsor_id); // menyinkronkan data yang ada di dalam tabel pivot
        $event->artis()->sync($request->artis_id); // menyinkronkan data yang ada di dalam tabel pivot

        // Redirect atau respons setelah update berhasil
        return redirect()->route('event.index')->with('Berhasil', 'Event berhasil Diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(event $event)
    {
        // jika tidak masalah akan langsung diarah kan ke try
        try {
            $filename = $event->foto;
            $event->delete();
            Storage::disk('public')->delete($filename); // menghapus data  foto yang ada didalam public
            return redirect()->route('event.index')->with('Berhasil', 'Data Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) { // jika ada yang error pada database-nya
            return redirect()->back()->withErrors('Data Tidak Bisa Di hapus Karena Masih Berelasi');
        }
    }
}
