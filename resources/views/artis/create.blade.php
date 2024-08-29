@extends('layouts.app')

@section('content')

<h2>Create New Artis</h2>

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
        <label for="artis">Artis Name:</label>
        <input type="text" name="artis" class="form-control" value="{{ old('artis') }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
    <a href="{{ route('artiss.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
