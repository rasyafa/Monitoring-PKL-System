<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

        :root {
            --main-bg-color: #009d63;
            --main-text-color: #30ed30;
            --second-text-color: #464343;
            /* Set text color to black */
            --second-bg-color: #ffffff;
            /* Gradient colors */
            --toggle-color: #32CD32;
            /* Toggle button color */
            --heading-color: #32CD32;
            /* Siswa heading color */
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
            /* Apply gradient */
        }
        .rounded-full {
            border-radius: 100%;
        }
        #wrapper {
            overflow-x: hidden;
            background: #fff;
        }
        #sidebar-wrapper {
            position: fixed;  /* Menetapkan posisi fixed agar sidebar tetap di tempat */
            top: 0;
            left: 0;
            width: 15rem; /* Lebar sidebar */
            min-height: 100vh; /* Menjaga agar sidebar memenuhi tinggi layar */
            background: var(--second-bg-color);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); /* Memberikan bayangan pada sidebar */
            transition: margin 0.25s ease-out;
        }

        #page-content-wrapper {
            margin-left: 15rem; /* Menyisakan ruang untuk sidebar tetap ada di layar */
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            color: var(--heading-color);
            /* Set heading color to #92C7CF */
        }
        #page-content-wrapper {
            margin-left: 15rem; /* Menyisakan ruang untuk sidebar saat terbuka */
            transition: margin 0.25s ease-out; /* Efek transisi untuk margin */
        }

        /* Ketika sidebar ditutup, pastikan konten bergerak ke pinggir */
        #wrapper.toggled #page-content-wrapper {
            margin-left: 0;
        }

        #menu-toggle {
            cursor: pointer;
            color: var(--toggle-color);
        }

        .list-group {
            list-style-type: none;
            padding-left: 0;
        }

        .list-group-item {
            border: none;
            padding: 20px 30px;
            color: var(--second-text-color);
            transition: background-color 0.3s;
        }

        .list-group-item:hover {
            background-color: rgba(50, 255, 19, 0.757);
            /* Hover effect */
        }

        .list-group-item.active {
            background-color: transparent;
            color: var(--second-text-color);
            /* Set active link color to black */
            font-weight: bold;
            border: none;
        }


        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }


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
            max-width: 100%;  /* Memastikan canvas responsif */
            max-height: 100%; /* Memastikan canvas tidak melebihi tinggi container */
        }

        @media (max-width: 768px) {
        .card {
            margin-left: 10px;
            margin-right: 10px;
        }
    }

    </style>
</head>

<body>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-shield"></i> ADMIN
            </div>
            <div class="list-group list-group-flush my-3">
                <!-- Dashboard -->
                <a href="dashboard" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>

                <!-- Dropdown for Manage Users -->
                <a class="list-group-item list-group-item-action bg-transparent second-text fw-bold dropdown-toggle"
                    data-bs-toggle="collapse" href="#manageUsersDropdown" role="button" aria-expanded="false"
                    aria-controls="manageUsersDropdown">
                    <i class="fas fa-users me-2"></i>Manage Users
                </a>

                <div class="collapse" id="manageUsersDropdown">
                    <ul class="list-group list-group-flush ms-3">
                        <li><a href="#" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-user-graduate me-2"></i>Data Siswa</a>
                        </li>
                        <li><a href="#" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-chalkboard-teacher me-2"></i>Data Pembimbing</a>
                        </li>
                        <li><a href="#" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-handshake me-2"></i>Data Mitra</a>
                        </li>
                        <li><a href="#" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-user-tie me-2"></i>Data Mentor</a>
                        </li>
                    </ul>
                </div>

                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-calendar-check me-2"></i>Laporan Absen</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-file-alt me-2"></i>Laporan Siswa</a>


                <!-- Logout -->

                <button type="submit"
                    class="list-group-item list-group-item-action bg-transparent text-danger fw-bold mt-2"
                    style="border: none; background: none;">
                    <i class="fas fa-power-off me-2"></i>Log out
                </button>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Navbar -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h1 class="text-end ms-3" style="padding-left: 5px; margin-bottom: 0;">Dashboard
                    </h1>
                </div>
            </nav>

                <!-- Card Data Siswa -->
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

                <!-- Card untuk data Pembimbing -->
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

                    <!-- Card untuk Data mitra -->
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

                    <!-- Card Untuk DataMentor -->
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
            </div>
        </div>
        <script>
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


            var ctxPembimbing = document.getElementById('chartPembimbing').getContext('2d');
            var chartPembimbing = new Chart(ctxPembimbing, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'july', 'agust', 'sep', 'okto', 'nov', 'des'],
                    datasets: [{
                        label: 'Jumlah Pembimbing',
                        data: [10, 15, 5, 25, 30, 35, 2, 70, 33, 11, 19, 50,],
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
        </script>
        <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>



</body>

</html>
