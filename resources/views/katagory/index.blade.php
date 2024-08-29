@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h1>List of Katagories</h1>
<a href="{{ route('katagory.create') }}" class="btn btn-primary">Create Katagory</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Katagory</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($katagories as $katagory)
            <tr>
                <td>{{ $katagory->id }}</td>
                <td>{{ $katagory->katagory }}</td>
                <td>
                   
                    <a href="{{ route('katagoryes.edit', $katagory->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('katagoryes.destroy', $katagory->id) }}" method="POST" style="display:inline;">
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
