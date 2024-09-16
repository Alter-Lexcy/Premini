@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4 bg-body-tertiary rounded">
            <div class="card-body">
            <h2 class="text-center mb-4">Timeline Roadmap</h2>

                @if ($roadmaps->isEmpty())
                    <p class="text-center">Belum ada roadmap yang tersedia.</p>
                @else
                    @php
                        // variabel untuk menyimpan data yang memiliki event_id yang sama
                        $groupedRoadmaps = $roadmaps->groupBy('event_id');
                    @endphp
                    {{-- forech untuk menampilkan data secar perulang sesuai dengan banyaknya data dan menampilkan nya sesuai dengan event_id --}}
                    @foreach ($groupedRoadmaps as $eventId => $roadmapGroup)
                        <h4 class="mt-4">{{ $roadmap->event->nama_event }}</h4>
                        <ul class="timeline">
                            @foreach ($roadmapGroup as $roadmap)
                                <li class="timeline-item">
                                    <h5>{{ $roadmap->jam_acara }}</h5>
                                    <p>{{ $roadmap->deskripsi_acara }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                @endif

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('roadmap.index') }}" class="btn btn-primary mt-4">Kembali</a>
                    <a href="{{ route('event.index') }}" class="btn btn-info mt-4">Kembali Ke Event</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .timeline {
            list-style: none;
            padding: 0;
        }

        .timeline-item {
            position: relative;
            padding-left: 40px;
            margin-bottom: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 5px;
            height: 100%;
            width: 2px;
            background-color: #007bff;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #007bff;
        }
    </style>
@endsection
