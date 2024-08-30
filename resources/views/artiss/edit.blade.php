@extends('layouts.app')

@section('content')
    <h1>Edit Artis</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{ route('artiss.update', $artiss->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="artis">Artis:</label>
                <input type="text" name="artis" value="{{ $artiss->artis }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>        
    @endsection
