@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4 bg-body-tertiary rounded">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <h1>Detail {{$event->nama_event}}</h1>
                </div>
                <div class="mb-2 text-center">
                    <img src="{{asset('storage/'. $event->foto)}}" id="preview-selected-image" class="img-thumbnail shadow p-1 bg-body-tertiary" style="max-width: 25%; height: auto;" />
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Event</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama_event"
                        value="{{ $event->nama_event }}" disabled>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Mulai</label>
                        <input type="text" class="form-control" name="mulai"
                        {{-- Carbon berfungsi untuk mengubah format date --}}
                            value="{{ \Carbon\Carbon::parse($event->mulai)->translatedFormat('d F Y') }}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Berakhir</label>
                        <input type="text" class="form-control" name="berakhir"
                        {{-- Carbon berfungsi untuk mengubah format date --}}
                            value="{{ \Carbon\Carbon::parse($event->berakhir)->translatedFormat('d F Y') }}" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Sponsor</label>
                    <input type="text" class="form-control" name="berakhir"
                        value="{{ $event->sponsor->pluck('nama_sponsor')->implode(', ') }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Artis</label>
                    <input type="text" class="form-control" name="berakhir"
                        value="{{ $event->artis->pluck('artis')->implode(', ') }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Pembuat Event</label>
                    <input type="text" class="form-control" name="berakhir" value="{{ $event->venue->NamaPembuatEvent }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kategori Event </label>
                    <input type="text" class="form-control" name="berakhir" value="{{ $event->category->categori }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" name="stok" value="{{ $event->stok }}" disabled>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('event.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
