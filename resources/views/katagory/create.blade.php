@extends('layouts.app')

@section('content')

<h2>Create New Katagory</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('katagoryes.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="katagory">Katagory:</label>
        <input type="text" name="katagory" class="form-control" value="{{ old('katagory') }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
    <a href="{{ route('katagoryes.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
