@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@section('content')


<div class="row">
    <!-- Card: Jumlah Siswa -->
    <div class="col-md-4">
        <div class="card text-center" style="background-color: #32cd32; color: white;">
            <div class="card-body">
                <i class="fas fa-user-graduate fa-3x mb-3"></i>
                <h5 class="card-title">Jumlah Siswa</h5>
                <p class="card-text" style="font-size: 24px; font-weight: bold;">{{ $data['students_count'] }}</p>
            </div>
        </div>
    </div>

    <!--  Card: Jumlah Pembimbing -->
    <div class="col-md-4">
        <div class="card text-center" style="background-color: #32cd32; color: white;">
            <div class="card-body">
                <i class="fas fa-chalkboard-teacher fa-3x mb-3"></i>
                <h5 class="card-title">Jumlah Pembimbing</h5>
                <p class="card-text" style="font-size: 24px; font-weight: bold;">{{ $data['pembimbing_count'] }}</p>
            </div>
        </div>
    </div>

    <!--  Card: Jumlah Mentor -->
    <div class="col-md-4">
        <div class="card text-center" style="background-color: #32cd32; color: white;">
            <div class="card-body">
                <i class="fas fa-user-tie fa-3x mb-3"></i>
                <h5 class="card-title">Jumlah Mentor</h5>
                <p class="card-text" style="font-size: 24px; font-weight: bold;">{{ $data['mentors_count'] }}</p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // FullCalendar Initialization
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Display calendar in monthly view
            headerToolbar: {
                left: 'prev,next today', // Buttons for navigation
                center: 'title', // Display title
                right: 'dayGridMonth,dayGridWeek,dayGridDay' // View options
            },
            events: [

            ]
        });

        calendar.render();
    });
</script>

@endpush

@push('styles')
<style>
    /* style untuk Card diagram */
    .card {
        margin-left: 1rem;  /* Memberikan jarak kiri */
        margin-right: 1rem; /* Memberikan jarak kanan */
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(27, 25, 25, 0.1);
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(35, 33, 33, 0.091);
    }

    .card-header {
        background-color: transparent;
        border-bottom: none;
    }

    .card-header h5 {
        margin: 0;
    }

    .card-body {
        padding: 10px;
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
    }

    .chart-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 300px;
    }

    .chart-container canvas {
        max-width: 100%;    /* Memastikan canvas responsif */
        max-height: 100%;   /* Memastikan canvas tidak melebihi tinggi container */
    }

    @media (max-width: 768px) {
        .card {
            margin-left: 10px;
            margin-right: 10px;
        }
    }

    #calendar {
        height: 500px;  /* Atur tinggi kalender sesuai kebutuhan */
        max-width: 100%;
        margin: 0 auto;
    }
</style>
@endpush

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
@endpush
