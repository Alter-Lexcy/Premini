@extends('layouts.app')

@section('content')

<header class=" mt-5">
    <div class="container d-flex flex-column align-items-center">
        <div class="mb-3">
            <a href="/" class="text-dark text-decoration-none">
                <span class="fs-4 fw-bold">EventLink</span>
            </a>
        </div>
        <div class="card mt-4" style="width: 50%;">
            <div class="card-body text-center">
                <h5 class="card-title fw-semibold">Selamat Datang di EventLink</h5>
                <p class="card-text">Gunakan tombol di Kiri untuk Melihat Event Dan <br> Tombol Kanan Untuk membuat Tiket</p>
                <div class="btn-group gap-2">
                    <a href="{{ route('event.index') }}" class="btn btn-primary" data-mdb-ripple-init>Lihat Event</a>
                    <a href="{{ route('attendes.create') }}" class="btn btn-success">Tambah Pengunjung</a>
                </div>
            </div>
        </div>
    </div>
</header>

@endsection
