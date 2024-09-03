@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body fw-bold">
                <center>
                    <h1>Ubah Event</h1>
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
                    <div class="form-group mb-3">
                        <center>
                            @if ($event->foto)
                                <img id="preview-image" src="{{ asset('storage/' . $event->foto) }}" alt=""
                                    class="img-thumbnail; shadow-lg p-1 my-3 bg-body-tertiary rounded;" width="200">
                            @else
                                <img id="preview-image" class="img-thumbnail; shadow-lg p-1 my-3 bg-body-tertiary rounded;"
                                    width="200" style="display: none;">
                            @endif <br>
                        </center>
                        <label for="image">Poster</label>
                        <input type="file" id="foto" name="foto" class="form-control mb-2" accept="image/*,.webp"
                            onchange="previewImage(event)">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Event</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="nama_event" value="{{ $event->nama_event }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="mulai" value="{{ $event->mulai }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="berakhir" value="{{ $event->berakhir }}">
                    </div>
                    <div class="mb-3">
                        <label for="guru" class="form-label">Sponsor</label>
                        <select class="form-control" id="Sponsor" name="sponsor_id">
                            <option value="" disabled selected>Pilih Sponsor</option>
                            @foreach ($sponsor as $sponsor)
                                <option value="{{ $sponsor->id }}"
                                    {{ $event->sponsor_id == $sponsor->id ? 'selected' : '' }}>{{ $sponsor->nama_sponsor }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="guru" class="form-label">Nama Artis</label>
                        <select class="form-control" id="artis_id" name="artis_id">
                            <option value="" disabled selected>Pilih Artis</option>
                            @foreach ($artis as $artis)
                                <option value="{{ $artis->id }}" {{ $event->artis_id == $artis->id ? 'selected' : '' }}>
                                    {{ $artis->artis }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="guru" class="form-label">Nama Pemilik Event</label>
                        <select class="form-control" id="venue_id" name="venue_id">
                            <option value="" disabled selected>Pilih Pemilik</option>
                            @foreach ($venue as $venue)
                                <option value="{{ $venue->id }}"
                                    {{ $event->venue_id == $venue->id ? 'selected' : '' }}>{{ $venue->NamaPembuatEvent }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="guru" class="form-label">Kategori Event</label>
                        <select class="form-control" id="categori_id" name="categori_id">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($category as $category)
                                <option value="{{ $category->id }}"
                                    {{ $event->categori_id == $category->id ? 'selected' : '' }}>{{ $category->categori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="stok" value="{{ $event->stok }}">
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <a href="{{ route('event.index') }}" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-success ms-auto">Kirim</button>
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
    </script>
@endsection
