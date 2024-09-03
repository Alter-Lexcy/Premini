@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body fw-bold">
                <center>
                    <h1>Detail Event</h1>
                </center>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Event</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="nama_event" value="{{ $event->nama_event }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Mulai</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="mulai" value="{{ \Carbon\Carbon::parse($event->mulai)->translatedFormat('d F Y') }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Berakhir</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="berakhir" value="{{ \Carbon\Carbon::parse($event->berakhir)->translatedFormat('d F Y') }}"
                        disabled>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Sponsor</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="berakhir" value="{{ $event->sponsor->nama_sponsor }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Artis</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="berakhir" value="{{ $event->artis->artis }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Artis</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="berakhir" value="{{ $event->venue->NamaPembuatEvent }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Artis</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled
                        name="berakhir" value="{{ $event->category->categori }}" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="stok" value="{{ $event->stok }}" disabled>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <a href="{{ route('event.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
