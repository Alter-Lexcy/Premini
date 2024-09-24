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
                <h2 class="text-center mb-4">Buat Roadmap Baru</h2>
                <form action="{{ route('roadmap.store') }}" method="POST" id="multi-form">
                    @csrf
                    <!-- Pilih Event hanya satu kali -->
                    <div class="mb-3">
                        <label for="event_id" class="form-label">Pilih Event</label>
                        <select name="event_id" id="event_id" class="form-control">
                            <option value="" selected disabled>Pilih Event</option>
                            @foreach ($dataEvent as $data)
                                <option value="{{ $data->id }}" {{ old('event_id') == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_event }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="form-container">
                        <!-- Default form row untuk input jam_acara dan deskripsi -->
                        <div class="row form-row">
                            <div class="mb-3 col-md-4">
                                <label for="jam_acara_0" class="form-label">Jam Acara</label>
                                <input type="time" class="form-control" id="jam_acara_0" name="roadmaps[0][jam_acara]">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="deskripsi_acara_0" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi_acara_0" name="roadmaps[0][deskripsi_acara]" rows="3">{{old('deskripsi_acara')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('roadmap.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="button" class="btn btn-primary" id="add-form-row">Tambah Baris</button>
                        <button type="submit" class="btn btn-success">Simpan Semua</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- script untuk membuat multi-form --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let formCount = 1;

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
