@extends('layouts.app')
@section('content')
<header class="border-bottom mt-n2">
    <div class="container d-flex flex-wrap justify-content-center mb-3 ">
      <a href="{{route('attendes.index')}}" class="d-flex align-items-center me-lg-auto text-dark text-decoration-none">
        <span class="fs-5">Peserta</span>
      </a>
    </div>
  </header>
    <div class="container mt-2">
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
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
        <div class="containe d-flex justify-content-between  mt-3 mb-2">
            <a href="{{ route('tiket.create') }}" class="btn btn-info">Beli Tiket</a>
            <a href="{{ route('attendes.create') }}" class="btn btn-success ">Tambah</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">No.Hp</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($attendes as $attende)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $attende->nama }}</td>
                        <td>{{ $attende->email }}</td>
                        <td>{{ $attende->phone }}</td>
                        <td>

                            <a href="{{ route('attendes.edit', $attende->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('attendes.destroy', $attende->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus Data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
