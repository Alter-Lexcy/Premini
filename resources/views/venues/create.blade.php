@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body fw-bold">
                <center>
                    <h1>Tambah Pemilik</h1>
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
                <form action="{{ route('venues.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Pemilik</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="NamaPembuatEvent" value="{{ old('NamaPembuatEvent') }}">
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <a href="{{ route('venues.index') }}" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-success ms-auto">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
