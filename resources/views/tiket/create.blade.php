@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body fw-bold">
                <center>
                    <h1>Tambah Tiket</h1>
                </center>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('tiket.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="guru" class="form-label">Nama Peserta</label>
                        <select class="form-control" id="artis_id" name="Nama_id">
                            <option value="" disabled selected>Pilih Peserta</option>
                            @foreach ($peserta as $peserta)
                                <option value="{{ $peserta->id }}"
                                    {{ old('Nama_id') == $peserta->id ? 'selected' : '' }}>{{ $peserta->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="guru" class="form-label">Nama Event</label>
                        <select class="form-control" id="venue_id" name="event_id">
                            <option value="" disabled selected>Pilih Event</option>
                            @foreach ($event as $event)
                                <option value="{{ $event->id }}"
                                    {{ old('event_id') == $event->id ? 'selected' : '' }}>{{ $event->nama_event }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tiket Pembelian</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="jumlah_tiket" value="{{ old('jumlah_tiket') }}">
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <a href="{{ route('tiket.index') }}" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-success ms-auto">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
