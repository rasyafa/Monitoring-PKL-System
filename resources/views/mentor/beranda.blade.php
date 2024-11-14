<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard Mentor</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Custom Styles */
        :root {
            --main-bg-color: #009d63;
            --main-text-color: #32cd32;
            --second-text-color: #333;
            --second-bg-color: #fff;
            --toggle-color: #32cd32;
            --heading-color: #32cd32;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
            overflow-x: hidden;
        }

        #sidebar-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 20rem;
            background: var(--second-bg-color);
            transition: margin 0.25s ease-out;
            z-index: 1000;
            overflow-y: auto;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 1rem;
            font-size: 1.2rem;
            color: var(--heading-color);
            text-align: center;
        }

        #page-content-wrapper {
            width: 100%;
            transition: margin 0.25s ease-out;
            padding-top: 20px;
            margin-left: 20rem;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: -20rem;
        }

        #wrapper.toggled #page-content-wrapper {
            margin-left: 0;
        }

        #menu-toggle {
            cursor: pointer;
            color: var(--toggle-color);
            font-size: 30px;
            margin-right: 10px;
        }

        /* Menghilangkan bullet pada dropdown menu */
        #manageUsersDropdown ul {
            list-style-type: none;
            /* Menghilangkan bullet */
            padding-left: 0;
            /* Menghilangkan padding kiri default */
        }

        /* Optional: Menghilangkan margin kiri pada elemen list-group dalam dropdown */
        #manageUsersDropdown .list-group-flush {
            margin-left: 0;
        }


        .list-group-item {
            border: none;
            padding: 20px 30px;
            color: var(--second-text-color);
            transition: background-color 0.3s, color 0.3s;
        }

        .list-group-item:hover {
            background-color: rgba(0, 0, 0, 0.1);
            color: var(--main-bg-color);
        }

        .list-group-item.active {
            background-color: transparent;
            color: var(--second-text-color);
            font-weight: bold;
            border: none;
        }

        .header-bar {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header-bar h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: bold;
            margin-left: auto;
        }

        .siswa-details {
            display: none;
            margin-left: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .chart {
            height: 300px;
            animation: chartAnim 1s ease-out;
        }

        @keyframes chartAnim {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .btn-toggle {
            background-color: #00bfae;
            color: #fff;
            border: none;
            font-size: 20px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-toggle:hover {
            background-color: #0fb8a0;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-chalkboard-teacher me-2"></i>Mentor
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text active">
                    <i class="fas fa-home me-2"></i>Beranda</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-user me-2"></i>Profil</a>
                <!-- Dropdown for Manage Users -->
                <a class="list-group-item list-group-item-action bg-transparent second-text fw-bold dropdown-toggle"
                    data-bs-toggle="collapse" href="#manageUsersDropdown" role="button" aria-expanded="false"
                    aria-controls="manageUsersDropdown">
                    <i class="fas fa-users me-2"></i>Siswa
                </a>

                <div class="collapse" id="manageUsersDropdown">
                    <ul class="list-group list-group-flush ms-3">
                        <li><a href="#" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-user-graduate me-2"></i>Data</a>
                        </li>
                        <li><a href="#" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-chalkboard-teacher me-2"></i>Absen</a>
                        </li>
                        <li><a href="{{ route('mentor.kegiatansiswa') }}" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-handshake me-2"></i>Kegiatan Harian</a>

                        </li>
                        <li><a href="#" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-user-tie me-2"></i>Nilai</a>
                        </li>
                    </ul>
                </div>

                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-bell me-2"></i>Notifikasi</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
                    <i class="fas fa-power-off me-2"></i>Keluar</a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="ms-auto">Dashboard</h2>
                </div>
            </nav>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Siswa</h5>
                            <div class="chart bg-light mt-3">
                                <canvas id="studentChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Mitra</h5>
                            <div class="chart bg-light mt-3">
                                <canvas id="partnerChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Pembimbing</h5>
                            <div class="chart bg-light mt-3">
                                <canvas id="mentorChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        // Chart.js Initialization
        var studentCtx = document.getElementById('studentChart').getContext('2d');
        var studentChart = new Chart(studentCtx, {
            type: 'doughnut',
            data: {
                labels: ['Siswa 1', 'Siswa 2', 'Siswa 3', 'Siswa 4'],

                datasets: [{
                    label: 'Jumlah Siswa',
                    data: [10, 20, 30, 40],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                    borderColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleFont: {
                            size: 16
                        },
                        bodyFont: {
                            size: 14
                        },
                        padding: 10
                    }
                }
            }
        });

        var partnerCtx = document.getElementById('partnerChart').getContext('2d');
        var partnerChart = new Chart(partnerCtx, {
            type: 'doughnut',
            data: {
                labels: ['Mitra 1', 'Mitra 2', 'Mitra 3', 'Mitra 4'],
                datasets: [{
                    label: 'Jumlah Mitra',
                    data: [15, 25, 35, 25],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                    borderColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleFont: {
                            size: 16
                        },
                        bodyFont: {
                            size: 14
                        },
                        padding: 10
                    }
                }
            }
        });


        var mentorCtx = document.getElementById('mentorChart').getContext('2d');
        var mentorChart = new Chart(mentorCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sept', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Pembimbing',
                    data: [12, 19, 3, 5, 2, 3, 10, 8, 9, 15, 20, 2],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleFont: {
                            size: 16
                        },
                        bodyFont: {
                            size: 14
                        },
                        padding: 10
                    }
                }
            }
        });

    </script>


</body>

</html>
