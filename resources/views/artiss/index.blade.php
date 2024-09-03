@extends('layouts.app')
@section('content')
<header class="border-bottom mt-n2">
    <div class="container d-flex flex-wrap justify-content-center mb-3 ">
      <a href="{{route('artiss.index')}}" class="d-flex align-items-center me-lg-auto text-dark text-decoration-none">
        <span class="fs-5">Artis</span>
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
        <div class="containe  d-flex justify-content-end mt-3">
            <a href="{{ route('artiss.create') }}" class="btn btn-success mb-2">Tambah</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Artis</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($artiss as $row)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $row->artis }}</td>
                        <td>

                            <a href="{{ route('artiss.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('artiss.destroy', $row->id) }}" method="POST" class="d-inline">
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
