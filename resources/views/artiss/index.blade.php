@extends('layouts.app')

@section('content')
    <h1>List of Artiss</h1>
    <a href="{{ route('artiss.create') }}" class="btn btn-primary">Add New Artis</a>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Artis</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                    $no = 1;
                @endphp
            @foreach ($artiss as $artis)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $artis->id }}</td>
                    <td>{{ $artis->artis }}</td>
                    <td>
                        <a href="{{ route('artiss.edit', $artis->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('artiss.destroy', $artis->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endsection
