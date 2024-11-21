<!-- resources/views/layouts/app.blade.php -->
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
    <title>@yield('title', 'Beranda Siswa')</title>
    <style>
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
                <a href="{{ route('pembimbing.home') }}" class="list-group-item list-group-item-action bg-transparent second-text active">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="{{ route('pembimbing.profil', Auth::user()->id) }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-user me-2"></i>Profil</a>
                <a class="list-group-item list-group-item-action bg-transparent second-text fw-bold dropdown-toggle"
                    data-bs-toggle="collapse" href="#manageUsersDropdown" role="button" aria-expanded="false"
                    aria-controls="manageSiswaDropdown">
                    <i class="fas fa-users me-2"></i>Siswa
                </a>

                <div class="collapse" id="manageUsersDropdown">
                    <ul class="list-group list-group-flush ms-4">
                        <a href="{{ route('pembimbing.datasiswa') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                            <i class="fas fa-users me-2"></i>Data Siswa</a>
                        <a href="{{ route('pembimbing.absen') }}"
                            class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                            <i class="fas fa-calendar-check me-2"></i>Absen
                        </a>
                        <a href="{{ route('pembimbing.laporanharian') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                            <i class="fas fa-file-alt me-2"></i>Laporan Harian</a>
                        <a href="{{ route('pembimbing.laporan') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                                <i class="fas fa-file-alt me-2"></i>Data Laporan Akhir</a>
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
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                </div>
            </nav>

            <!-- Konten Utama -->
            <div class="container mt-5">
                @yield('content') <!-- Tempat konten halaman spesifik -->
            </div>
        </div>
    </div>

    <!-- JavaScript includes -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // JavaScript for sidebar toggle and charts (can be moved to a dedicated JS file)
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
        // Add the remaining JavaScript code here
    </script>
</body>

</html>
