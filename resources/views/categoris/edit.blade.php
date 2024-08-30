<!-- resources/views/categoris/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Categori</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categoris.update', $categori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="categori">Categori Name:</label>
            <input type="text" name="categori" value="{{ $categori->categori }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
