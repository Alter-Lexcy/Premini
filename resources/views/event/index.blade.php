@extends('layouts.app')
@section('content')
    <header class="border-bottom mt-n2">
        <div class="container d-flex flex-wrap justify-content-between align-items-center mb-3">
            <a href="{{ route('event.index') }}" class="d-flex align-items-center me-lg-auto text-dark text-decoration-none">
                <span class="fs-5">Event</span>
            </a>
            <form method="GET" action="{{ route('event.index') }}">
                <input type="text" name="search" placeholder="Cari" value="{{ old('search', $search) }}">
                <button type="submit" class="btn btn-link p-0 m-0"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </header>

    <div class="container mt-2">
        @if (session('Berhasil'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('Berhasil') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container d-flex justify-content-between mt-3">
            <a href="{{route('roadmap.index')}}" class="btn btn-secondary mb-2">Lihat Roadmap</a>
            <a href="{{ route('event.create') }}" class="btn btn-success mb-2">Tambah</a>
        </div>

        <div class="row ">
            @foreach ($data as $row)
                <div class="col-md-4 mb-4">
                    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded"
                        style="width: 100%; border-radius: 10px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $row->foto) }}" class="card-img-top"
                            style="width: 100%; height: 30vh; object-fit: cover;" alt="{{ $row->nama_event }}">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title fw-bold">{{ $row->nama_event }}</h5>
                            </center>
                            <p class="card-text">
                                Artis: {{ $row->artis->pluck('artis')->implode(', ') }}<br>
                                Stok: {{ $row->stok }} <br>
                                Kategori: {{ $row->category->categori }}
                            </p>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-info" href="{{ route('event.show', $row->id) }}">Detail</a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="{{ route('event.destroy', $row->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                        </li>
                                        <li><a class="dropdown-item text-warning"
                                                href="{{ route('event.edit', $row->id) }}">Ubah</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-3">
                {{-- untuk memanggil page baru untuk sistem paginate --}}
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
