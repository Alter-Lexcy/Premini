<!-- resources/views/venues/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Venue</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('venues.update', $venue->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="NamaPembuatEvent">Nama Pembuat Event:</label>
            <input type="text" name="NamaPembuatEvent" value="{{ $venue->NamaPembuatEvent }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
