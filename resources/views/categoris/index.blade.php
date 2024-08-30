<!-- resources/views/categoris/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>List of Categoris</h1>
    <a href="{{ route('categoris.create') }}" class="btn btn-primary">Add New Categori</a>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>categori</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                    $no = 1;
                @endphp
            @foreach ($categoris as $categori)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $categori->id }}</td>
                    <td>{{ $categori->categori }}</td>
                    <td>
                        <a href="{{ route('categoris.edit', $categori->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('categoris.destroy', $categori->id) }}" method="POST" style="display:inline;">
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
