@extends('layouts.app')

@section('content')
    <h1>Create New Artis</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('artiss.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="artis">Artis:</label>
            <input type="text" name="artis" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    @endsection
