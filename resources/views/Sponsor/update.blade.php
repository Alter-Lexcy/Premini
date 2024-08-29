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
                <form action="{{ route('sponsors.update',$sponsor->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="nama_sponsor" value="{{$sponsor->nama_sponsor}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kontribusi (opsional)</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="kontribusi" value="{{ $sponsor->kontribusi }}">
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <a href="{{ route('sponsors.index') }}" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-success ms-auto">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
