@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@section('content')
<div class="row justify-content-center">
    <!-- Stat Card: Jumlah Siswa -->
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-container">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="ms-4">
                    <h6 class="card-title mb-1">Jumlah Siswa</h6>
                    <p class="stat-value mb-0">{{ $data['students_count'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Jumlah Pembimbing -->
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-container">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="ms-4">
                    <h6 class="card-title mb-1">Jumlah Pembimbing</h6>
                    <p class="stat-value mb-0">{{ $data['pembimbing_count'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Jumlah Mentor -->
    <div class="col-md-4">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-container">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="ms-4">
                    <h6 class="card-title mb-1">Jumlah Mentor</h6>
                    <p class="stat-value mb-0">{{ $data['mentors_count'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Card untuk Kalender --}}
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* style untuk stat card*/
    .stat-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #f8f9fa;
        transition: transform 0.3s ease-in-out;
        height: 130px;
        margin-left: 60px;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        display: flex;
        align-items: center;
    }

    /* Icon Styles  stat */
    .icon-container {
        width: 70px;
        height: 70px;
        background-color: #03d703;
        border-radius: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 32px;
    }

    /* Text Styles */
    .card-title {
        font-size: 18px;
        color: #1a3221;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stat-value {
        font-size: 26px;
        font-weight: bold;
        color: #343a40;
    }

    /* Calendar Card */
    /* .card-header {
        font-weight: bold;
        font-size: 18px;
    } */

    /* Calendar */
    #calendar {
    height: 600px; /* Perbesar tinggi kalender */
    width: 100%; /* Pastikan menggunakan seluruh lebar */
    margin: auto; /* Pusatkan kalender */
    font-size: 18px; /* Tingkatkan ukuran font */
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .stat-card {
            height: auto;
        }

        .icon-container {
            width: 50px;
            height: 50px;
            font-size: 24px;
        }

        .stat-value {
            font-size: 22px;
        }
    }
</style>
@endpush

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
<script>
    // FullCalendar Initialization
    document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: 'id', // Mengatur bahasa menjadi Bahasa Indonesia
    initialView: 'dayGridMonth',
    headerToolbar: {
    left: 'prev', // Tombol panah kiri
    center: 'title', // Judul kalender di tengah
    right: 'next' // Tombol panah kanan
    },
    events: [] // Tambahkan event di sini jika ada
    });

    calendar.render();
    });
</script>
@endpush
