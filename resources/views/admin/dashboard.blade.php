@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@section('content')

{{-- Card Kalender --}}
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h5 class="mb-0">Kalender</h5>
            </div>
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

{{-- Card untuk Data Siswa --}}
<div class="row mb-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h5 class="mb-0">Data Siswa</h5>
            </div>
            <div class="card-body">
                <div class="chart-container" style="width: 100%;">
                    <canvas id="chartSiswa" style="width: 100%; height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Card Data pembimbing --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h5 class="mb-0">Data Pembimbing</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartPembimbing"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Data Mitra --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h5 class="mb-0">Data Mitra</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartMitra"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Card data Mentor --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h5 class="mb-0">Data Mentor</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartMentor"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // scrip data siswa
    var ctxSiswa = document.getElementById('chartSiswa').getContext('2d');
    var chartSiswa = new Chart(ctxSiswa, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Jumlah Siswa',
                data: [50, 60, 70, 80, 90, 100, 50, 60, 70, 80, 100, 80],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // script Data pembimbing
    var ctxPembimbing = document.getElementById('chartPembimbing').getContext('2d');
    var chartPembimbing = new Chart(ctxPembimbing, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'july', 'agust', 'sep', 'okto', 'nov', 'des'],
            datasets: [{
                label: 'Jumlah Pembimbing',
                data: [10, 15, 5, 25, 30, 35, 2, 70, 33, 11, 19, 50],
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // script Data Mitra
    var ctxMitra = document.getElementById('chartMitra').getContext('2d');
    var chartMitra = new Chart(ctxMitra, {
        type: 'pie',
        data: {
            labels: ['Mitra A', 'Mitra B', 'Mitra C'],
            datasets: [{
                label: 'Jumlah Mitra',
                data: [30, 40, 30],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                        }
                    }
                }
            }
        }
    });

    // script Data Mentor
    var ctxMentor = document.getElementById('chartMentor').getContext('2d');
    var chartMentor = new Chart(ctxMentor, {
        type: 'doughnut',
        data: {
            labels: ['Mentor A', 'Mentor B', 'Mentor C'],
            datasets: [{
                label: 'Jumlah Mentor',
                data: [20, 30, 50],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                        }
                    }
                }
            }
        }
    });

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

        calendar.render(); // Render the calendar
    });
</script>
@endpush

@push('styles')
<style>
    /* style untuk Card diagram */
    .card {
        margin-left: 1rem;
        /* Memberikan jarak kiri */
        margin-right: 1rem;
        /* Memberikan jarak kanan */
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
        max-width: 100%;
        /* Memastikan canvas responsif */
        max-height: 100%;
        /* Memastikan canvas tidak melebihi tinggi container */
    }

    @media (max-width: 768px) {
        .card {
            margin-left: 10px;
            margin-right: 10px;
        }
    }

    #calendar {
        height: 500px;
        /* Atur tinggi kalender sesuai kebutuhan */
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
