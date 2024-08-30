<!-- resources/views/venues/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create New Venue</h1>
    
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
        <div class="form-group">
            <label for="NamaPembuatEvent">Nama Pembuat Event:</label>
            <input type="text" name="NamaPembuatEvent" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    @endsection
