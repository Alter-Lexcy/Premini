@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h1>List of Artis</h1>
<a href="{{ route('artis.create') }}" class="btn btn-primary">Create Artis</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Artis</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($artiss  as $artis )
            <tr>
                <td>{{ $artis ->id }}</td>
                <td>{{ $artis ->artis }}</td>
                <td>
                    
                    <a href="{{ route('artiss.edit', $artis ->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('artiss.destroy', $artis ->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
