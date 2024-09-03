@extends('layouts.app')
@section('content')
<header class="border-bottom mt-n2">
    <div class="container d-flex flex-wrap justify-content-center mb-3 ">
      <a href="{{route('sponsors.index')}}" class="d-flex align-items-center me-lg-auto text-dark text-decoration-none">
        <span class="fs-5">Sponsor</span>
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
        <div class="containe  d-flex justify-content-end mt-3">
            <a href="{{ route('sponsors.create') }}" class="btn btn-success mb-2">Tambah</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Sponsor</th>
                    <th scope="col">Kontribusi</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $row->nama_sponsor }}</td>
                        <td>{{ $row->kontribusi }}</td>
                        <td>

                            <a href="{{ route('sponsors.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('sponsors.destroy', $row->id) }}" method="POST" class="d-inline">
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
