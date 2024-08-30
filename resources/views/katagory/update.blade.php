@extends('layouts.app')

@section('content')

<h2>Edit Katagory</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('katagorys.update', $katagory->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="katagory">Katagory:</label>
        <input type="text" name="katagory" class="form-control" value="{{ old('katagory', $katagory->katagory) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('katagorys.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
