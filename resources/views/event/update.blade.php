@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="container mt-5">
        <div class="card shadow-lg p-4 bg-body-tertiary rounded">
            <div class="card-body">
                <center>
                    <h1 class="">Ubah Event</h1>
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
                <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4 text-center">
                        @if ($event->foto)
                            <img id="preview-image" src="{{ asset('storage/' . $event->foto) }}" alt="" class="img-thumbnail shadow p-1 mb-4 bg-body-tertiary" style="max-width: 25%; height: auto;">
                        @else
                            <img id="preview-image" class="img-thumbnail shadow p-1 mb-4 bg-body-tertiary" style="max-width: 25%; height: auto; display: none;">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Poster</label>
                        <input type="file" id="foto" name="foto" class="form-control" accept="image/*,.webp" onchange="previewImage(event)">
                    </div>
                    <div class="mb-3">
                        <label for="nama_event" class="form-label">Nama Event</label>
                        <input type="text" class="form-control" id="nama_event" name="nama_event" value="{{ $event->nama_event }}" placeholder="Masukkan nama event">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="mulai" name="mulai" value="{{ $event->mulai }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="berakhir" class="form-label">Tanggal Berakhir</label>
                            <input type="date" class="form-control" id="berakhir" name="berakhir" value="{{ $event->berakhir }}">
                        </div>
                    </div>
                    {{-- Menampilkan select sesuai data yang ada disponsor --}}
                    <div class="mb-3">
                        <label for="Sponsor" class="form-label">Sponsor</label>
                        <select class="form-control js-example-basic-multiple" id="Sponsor" name="sponsor_id[]" multiple="multiple">
                            @foreach ($sponsor as $sponsor)
                                <option value="{{ $sponsor->id }}" {{ in_array($sponsor->id, $sponsorTerpilih) ? 'selected' : '' }}>
                                    {{ $sponsor->nama_sponsor }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Menampilkan select sesuai data yang ada diartis --}}
                    <div class="mb-3">
                        <label for="artis" class="form-label">Nama Artis</label>
                        <select class="form-control js-example-basic-multiple" id="artis" name="artis_id[]" multiple="multiple">
                            @foreach ($artis as $artis)
                                <option value="{{ $artis->id }}" {{ in_array($artis->id, $artisTerpilih) ? 'selected' : '' }}>
                                    {{ $artis->artis }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="venue_id" class="form-label">Nama Pemilik Event</label>
                        <select class="form-control" id="venue_id" name="venue_id">
                            <option value="" disabled selected>Pilih Pemilik</option>
                            @foreach ($venue as $venue)
                                <option value="{{ $venue->id }}" {{ $event->venue_id == $venue->id ? 'selected' : '' }}>{{ $venue->NamaPembuatEvent }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="categori_id" class="form-label">Kategori Event</label>
                        <select class="form-control" id="categori_id" name="categori_id">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($category as $category)
                                <option value="{{ $category->id }}" {{ $event->categori_id == $category->id ? 'selected' : '' }}>{{ $category->categori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="{{ $event->stok }}" min="1" placeholder="Masukkan jumlah stok">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('event.index') }}" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-success">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview-image');
        preview.style.display = 'block';
        preview.src = URL.createObjectURL(event.target.files[0]);
    }
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: "Pilih item",
            allowClear: true
        });
    });
</script>
@endsection
