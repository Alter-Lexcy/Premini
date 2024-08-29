@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <h1>List of Attendes</h1>
    <a href="{{ route('attendes.create') }}" class="btn btn-primary">Create Attende</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendes as $attende)
                <tr>
                    <td>{{ $attende->id }}</td>
                    <td>{{ $attende->name }}</td>
                    <td>{{ $attende->email }}</td>
                    <td>{{ $attende->phone }}</td>
                    <td>
                        <a href="{{ route('attendes.show', $attende->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('attendes.edit', $attende->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('attendes.destroy', $attende->id) }}" method="POST" style="display:inline;">
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