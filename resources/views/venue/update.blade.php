@extends('layouts.app')

@section('content')

<h2>Edit Venue</h2>

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
        <input type="text" name="NamaPembuatEvent" class="form-control" value="{{ old('NamaPembuatEvent', $venue->NamaPembuatEvent) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('venues.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
