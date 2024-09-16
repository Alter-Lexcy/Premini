@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5">
        <div class="card shadow-lg p-4 bg-body-tertiary rounded">
            <div class="card-body">
                <h2 class="text-center mb-4">Edit Roadmap</h2>
                <form action="{{ route('roadmap.update', $event->id) }}" method="POST" id="multi-form">
                    @csrf
                    @method('PUT')
                    {{-- inputan Untuk  jam_acara dan  tanggal_acara --}}
                    <div id="form-container">
                        @foreach ($roadmaps as $index => $roadmap)
                        <div class="row form-row mb-3">
                            <div class="mb-3 col-md-4">
                                <label for="jam_acara_{{ $index }}" class="form-label">Jam Acara</label>
                                <input type="time" class="form-control" id="jam_acara_{{ $index }}" name="roadmaps[{{ $index }}][jam_acara]" value="{{ old('roadmaps.' . $index . '.jam_acara', $roadmap->jam_acara) }}" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="deskripsi_acara_{{ $index }}" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi_acara_{{ $index }}" name="roadmaps[{{ $index }}][deskripsi_acara]" rows="3" required>{{ old('roadmaps.' . $index . '.deskripsi_acara', $roadmap->deskripsi_acara) }}</textarea>
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-danger remove-form-row">Hapus Baris</button>
                            </div>
                        </div>
                    @endforeach
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('roadmap.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="button" class="btn btn-primary" id="add-form-row">Tambah Baris</button>
                        <button type="submit" class="btn btn-success">Update Roadmap</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
                {{-- Script  untuk menambahkan baris baru --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let formCount = {{ count($roadmaps) }};

            document.getElementById('add-form-row').addEventListener('click', function() {
                const formContainer = document.getElementById('form-container');
                const newFormRow = document.createElement('div');
                newFormRow.className = 'row form-row mb-3';
                newFormRow.innerHTML = `
                    <div class="mb-3 col-md-4">
                        <label for="jam_acara_${formCount}" class="form-label">Jam Acara</label>
                        <input type="time" class="form-control" id="jam_acara_${formCount}" name="roadmaps[${formCount}][jam_acara]" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="deskripsi_acara_${formCount}" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_acara_${formCount}" name="roadmaps[${formCount}][deskripsi_acara]" rows="3" required></textarea>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button type="button" class="btn btn-danger remove-form-row">Hapus Baris</button>
                    </div>
                `;
                formContainer.appendChild(newFormRow);
                formCount++;
            });

            document.getElementById('form-container').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-form-row')) {
                    e.target.closest('.form-row').remove();
                }
            });
        });
    </script>
@endsection
