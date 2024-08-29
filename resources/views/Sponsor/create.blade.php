@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body fw-bold">
                <center>
                    <h1>Tambah Sponsor</h1>
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
                <form action="{{ route('Sponsor.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="nama_sponsor" value="{{ old('nama_sponsor') }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kontribusi</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="kontribusi" value="{{ old('kontribusi') }}">
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <a href="{{ route('Sponsor.index') }}" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-success ms-auto">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
