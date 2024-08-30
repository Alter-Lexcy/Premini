@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h1>List of Venues</h1>
<a href="{{ route('venues.create') }}" class="btn btn-primary">Create Venue</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Pembuat Event</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($venues as $venue)
            <tr>
                <td>{{ $venue->id }}</td>
                <td>{{ $venue->NamaPembuatEvent }}</td>
                <td>
                    
                    <a href="{{ route('venues.edit', $venue->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('venues.destroy', $venue->id) }}" method="POST" style="display:inline;">
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
