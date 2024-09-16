@extends('layouts.app')

@section('content')
    <header class="border-bottom mt-n2">
        <div class="container d-flex flex-wrap justify-content-between align-items-center mb-3">
            <a href="{{ route('roadmap.index') }}" class="d-flex align-items-center me-lg-auto text-dark text-decoration-none">
                <span class="fs-5">RoadMap</span>
            </a>
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
        <div class="container d-flex justify-content-end mt-3">
            <a href="{{ route('roadmap.create') }}" class="btn btn-success mb-2">Tambah</a>
        </div>
        <div class="row">
            @foreach ($data as $row)
                <div class="col-md-3 mb-3">
                    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title fw-bold">{{ $row->event->nama_event }}</h5>
                            </center>
                            <a href="{{ route('roadmap.show', $row->id) }}" class="btn btn-info btn-sm">Detail RoadMap</a>
                            <div class="btn-group ">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-warning" href="{{ route('roadmap.edit', $row->id) }}">Ubah</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('roadmap.destroy', $row->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
