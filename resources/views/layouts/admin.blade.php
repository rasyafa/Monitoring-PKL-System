<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Masukkan semua CSS dari file sebelumnya di sini */
        :root {
            --main-bg-color: #009d63;
            --main-text-color: #32CD32;
            --second-text-color: #464343;
            --second-bg-color: #ffffff;
            --toggle-color: #32CD32;
            --heading-color: #32CD32;
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
        }

        #sidebar-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 15rem;
        min-height: 100vh;
        background: var(--second-bg-color);
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        transition: left 0.25s ease-out; /* Tambahkan transisi untuk pergerakan sidebar */
        }

        #wrapper.toggled #sidebar-wrapper {
        left: -15rem; /* Geser sidebar ke luar layar sesuai lebar sidebar */
        }

        #page-content-wrapper {
        margin-left: 15rem;
        overflow-x: auto; /* Tambahkan gulir horizontal */
        transition: margin-left 0.25s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            color: var(--heading-color);
        }

        #wrapper.toggled #page-content-wrapper {
            margin-left: 0;
        }

        /* Tambahkan aturan ini untuk menyembunyikan konten saat sidebar terbuka */
        #page-content-wrapper {
            transition: margin-left 0.25s ease-out; /* Pastikan transisi halus */
        }

        /* style untuk hamburer agar tetap di posisi */
       #menu-toggle {
            position: fixed; /* Tetap di layar meskipun konten di-scroll */
            top: 20px; /* Jarak dari atas layar */
            left: 15rem; /* Jarak dari tepi kiri layar (sejajar dengan sidebar) */
            z-index: 1030; /* Pastikan tombol tetap di atas konten */
            padding: 10px;
    }


        #wrapper.toggled #menu-toggle {
            left: 0; /* Saat sidebar ditutup, tombol pindah ke tepi layar */
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
        }

        .list-group-item.active {
            background-color: transparent;
            color: var(--second-text-color);
            font-weight: bold;
            border: none;
        }

        .card {
            margin: 1rem;
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(27, 25, 25, 0.1);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(35, 33, 33, 0.091);
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-shield"></i> ADMIN
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-users me-2"></i>Manage Users
                </a>
                <a href="{{ route('admin.absen.index') }}"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-calendar-check me-2"></i>Data Absen
                </a>
                <a href="{{ route('admin.kegiatan.index') }}"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-file-alt me-2"></i>Data Laporan Harian
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-file-alt me-2"></i>Data Laporan Akhir
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="list-group-item list-group-item-action bg-transparent text-danger fw-bold mt-2"
                        style="border: none; background: none;">
                        <i class="fas fa-power-off me-2"></i>Log out
                    </button>
                </form>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h1 class="text-end ms-3" style="padding-left: 5px; margin-bottom: 0;">@yield('page-title',
                        'Manajemen Admin')</h1>
                </div>
            </nav>
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    @stack('scripts')
</body>

</html>
