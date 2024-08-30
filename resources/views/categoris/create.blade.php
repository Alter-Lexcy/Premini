<!-- resources/views/categoris/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create New Categori</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categoris.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="categori">Categori Name:</label>
            <input type="text" name="categori" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
