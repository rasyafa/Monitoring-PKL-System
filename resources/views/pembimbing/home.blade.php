<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
    <title>Beranda Siswa</title>
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
        }
        .expenses-card {
            background-color: #60a5fa;
        }
        .card-title {
            font-size: 1.2rem;
        }
        .card-value {
            font-size: 2.5rem;
            font-weight: bold;
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
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-graduate me-2"></i>Pembimbing
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text active">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-user me-2"></i>Profil</a>
                    <a class="list-group-item list-group-item-action bg-transparent second-text fw-bold dropdown-toggle"
                        data-bs-toggle="collapse" href="#manageUsersDropdown" role="button" aria-expanded="false"
                        aria-controls="manageSiswaDropdown">
                        <i class="fas fa-users me-2"></i>Siswa
                    </a>

                    <div class="collapse" id="manageUsersDropdown">
                        <ul class="list-group list-group-flush ms-3">
                            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                                <i class="fas fa-users me-2"></i>Data Siswa</a>
                            </li>
                            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                                <i class="fas fa-bell me-2"></i>Absen</a>
                            </li>
                            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                                <i class="fas fa-file-alt me-2"></i>Laporan Harian</a>
                        </ul>
                    </div>
                    <a href="{{ route('pembimbing.monitoring') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                        <i class="fas fa-file-alt me-2"></i>Monitoring</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-power-off me-2"></i>Logout
                </a>

                <!-- Form Logout -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->

        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <!-- Hamburger Button -->
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                </div>
            </nav>
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card income-card">
                                        <div class="card-body">
                                            <div class="card-title">Total Income</div>
                                            <div class="card-value">$ 579,000</div>
                                            <div class="card-subtext">Saved 25%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card expenses-card">
                                        <div class="card-body">
                                            <div class="card-title">Total Expences</div>
                                            <div class="card-value">$ 79,000</div>
                                            <div class="card-subtext">Saved 25%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <!-- Add the doughnut chart inside a new column in the existing row -->
            <div class="container-fluid px-4">
                <div class="row my-5">
                    <!-- Diagram Kolom -->
                    <div class="col-lg-6 chart-container">
                        <div class="card">
                            <h3 class="card-title text-center">Data Siswa per Bulan</h3>
                            <canvas id="myBarChart"></canvas>
                        </div>
                    </div>

                    <!-- Kalender -->
                    <div class="col-lg-6 calendar-container">
                        <div class="card">
                            <div id="calendar"></div>
                        </div>
                    </div>
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
        const ctxBar = document.getElementById('myBarChart').getContext('2d');
        const myBarChart = new Chart(ctxBar, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Data Siswa',
                    data: [39, 45, 40, 30, 60, 60, 50, 65, 70, 80, 55, 59, 100],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
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
                                return tooltipItem.raw + ' Siswa';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                    x: {
                        ticks: {
                            maxRotation: window.innerWidth < 768 ? 45 : 0, // Rotasi teks bulan di mobile
                            minRotation: window.innerWidth < 768 ? 45 : 0, // Rotasi teks bulan di mobile
                            font: {
                                size: window.innerWidth < 768 ? 10 : 12 // Mengatur ukuran font lebih kecil di mobile
                            }
                        }
                    }
                }
            }
        });



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
                events: []
            });
            calendar.render();
        });
    </script>
</body>

</html>
