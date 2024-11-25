<!-- resources/views/pembimbing/dashboard.blade.php -->
@extends('layouts.pembimbing')

@section('title', 'Dashboard Pembimbing') <!-- Set judul halaman -->

@section('content')


<style>
        :root {
            --main-bg-color: #03d703;
            --main-text-color: #03d703;
            --second-text-color: #686868;
            --second-bg-color: #fff;
            --toggle-color: #03d703;
            --heading-color: #03d703;
        }

        /* Jika sidebar terbuka */
        #wrapper.toggled #page-content-wrapper {
            margin-left: 15rem;
        }

        .card {
            border-radius: 10px;
            color: white;
            padding: 20px;
            margin: 10px;
        }

        .income-card {
            background-color: #03d703;
            width: 90%;
            /* Mengatur lebar menjadi 80% dari elemen induknya */
            max-width: 400px;
            /* Menetapkan lebar maksimum agar tetap responsif */
            padding: 10px;
            /* Mengurangi padding untuk mengecilkan ukuran */
            margin: 0 auto;
            /* Memastikan kolom berada di tengah */
        }

        .expenses-card {
            background-color: #60a5fa;
            width: 90%;
            /* Mengatur lebar menjadi 80% dari elemen induknya */
            max-width: 400px;
            /* Menetapkan lebar maksimum agar tetap responsif */
            padding: 10px;
            /* Mengurangi padding untuk mengecilkan ukuran */
            margin: 0 auto;
            /* Memastikan kolom berada di tengah */
        }

        .card-title {
            font-size: 1.2rem;
        }

        .card-subtext {
            font-size: 1rem;
        }

        .primary-text {
            color: var(--main-text-color);
        }

        .second-text {
            color: var(--second-text-color);
        }

        .primary-bg {
            background-color: var(--main-bg-color);
        }

        .secondary-bg {
            background: var(--second-bg-color);
        }

        .rounded-full {
            border-radius: 100%;
        }

        #wrapper {
            overflow-x: hidden;
            background: #fff;
            display: flex;
            height: 100vh;
            transition: margin-left 0.3s ease-out;
        }

        /* Sidebar fixed */
        #sidebar-wrapper {
            position: fixed;
            top: 0;
            left: -15rem;
            min-height: 100vh;
            background: var(--second-bg-color);
            width: 15rem;
            transition: margin 0.25s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            color: var(--heading-color);
        }

        #sidebar-wrapper .list-group {
            width: 100%;
        }

        #page-content-wrapper {
            margin-left: 0;
            width: 100%;
            padding: 0;
            transition: margin-left 0.25s ease;
        }

        #wrapper.toggled #sidebar-wrapper {
            left: 0;
        }

        /* Menambahkan aturan agar posisi tombol menu berubah saat sidebar terbuka */
        #menu-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1050;
            cursor: pointer;
            color: var(--toggle-color);
            transition: left 0.3s ease-out;
        }

        /* Ketika sidebar terbuka, pindahkan tombol ke kanan */
        #wrapper.toggled #menu-toggle {
            left: calc(25% - 90px);
            /* Sesuaikan posisi tombol ke kanan */
        }

        .list-group-item {
            border: none;
            padding: 20px 30px;
            color: var(--second-text-color);
            transition: background-color 0.3s;
        }

        .list-group-item:hover {
            background-color: rgba(11, 11, 11, 0.1);
        }

        .list-group-item.active {
            background-color: transparent;
            color: var(--second-text-color);
            font-weight: bold;
            border: none;
        }

        /* Layout Kalender dan Grafik dengan ukuran yang sama */
        .chart-container,
        .calendar-container {
            width: 100%;
            margin: 20px auto;
        }

        .chart-container canvas,
        .calendar-container #calendar {
            width: 100% !important;
            height: 100% !important;
        }

        .row.my-5 {
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            height: 100%;
            transition: margin-left 0.3s ease-out;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Mengatur posisi diagram agar sedikit lebih ke atas */
        .chart-container {
            margin-top: -20px;
        }

        /* Responsif */
        @media (max-width: 767px) {
            #wrapper {
                flex-direction: column;
            }

            #page-content-wrapper {
                margin-left: 0;
            }

            #sidebar-wrapper {
                position: fixed;
                top: 0;
                left: -15rem;
                z-index: 1030;
                transition: margin 0.25s ease-out;
            }

            #wrapper.toggled #sidebar-wrapper {
                left: 0;
            }

            /* Menyesuaikan card dengan lebar layar perangkat */
            .chart-container,
            .calendar-container {
                width: calc(100% - 30px);
                /* Mengurangi padding */
            }

            .row.my-5 {
                flex-direction: column;
            }

            /* Mengurangi tinggi diagram pada mobile */
            .chart-container canvas {
                height: 250px !important;
                /* Mengurangi tinggi diagram di mobile */
            }

            /* Mengatur rotasi teks bulan untuk tampilan mobile */
            .chart-container canvas {
                height: 250px !important;
                /* Menyesuaikan tinggi diagram */
            }
        }

        /* Untuk tampilan desktop */
        @media (min-width: 768px) {

            .chart-container,
            .calendar-container {
                max-width: 900px;
                /* Memperlebar diagram dan kalender */
                margin: 20px auto;
            }
        }
    </style>


    <div class="row">
        <div class="col-md-6">
            <div class="card income-card">
                <div class="card-body">
                    <div class="card-title">Kegiatan Harian</div>
                    <div class="card-subtext">{{ $studentsCount }}%</div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card expenses-card">
                <div class="card-body">
                    <div class="card-title">Data Absen</div>
                    <div class="card-subtext">{{ $absensCount }}%</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add the doughnut chart inside a new column in the existing row -->

            <!-- Kalender -->
            <div class="col-lg-6 calendar-container">
                <div class="card">
                    <h3 class="card-title text-center" style="color: #000;" id="calendar-title">Kalender</h3>
                    <div id="calendar"></div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Toggle sidebar on and off when the menu icon is clicked
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
        // Chart.js - Diagram Batang untuk Data Siswa per Bulan



        // FullCalendar
        document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: ''
                    },
                    height: 'auto',
                    events: [],
                    datesSet: function (info) {
                        // Update title with current month and year
                        var monthNames = [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ];
                        var currentMonth = monthNames[info.view.currentStart.getMonth()];
                        var currentYear = info.view.currentStart.getFullYear();
                        document.getElementById('calendar-title').textContent = 'Kalender ' + currentMonth + ' ' + currentYear;
                    }
                });
                calendar.render();
            });

    </script>

@endsection
