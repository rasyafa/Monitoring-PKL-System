<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        :root {
            --main-bg-color: #03d703;
            --main-text-color: #03d703;
            --second-text-color: #686868;
            --second-bg-color: #fff;
            --toggle-color: #03d703;
            --heading-color: #03d703;
        }

        .primary-text {
            color: var(--main-text-color);
        }

        .second-text {
            color: var(--second-text-color);
        }

        #wrapper {
            overflow-x: hidden;
            background: #fff;
            display: flex;
            height: 100vh;
            transition: margin-left 0.3s ease-out;
        }

        #sidebar-wrapper {
            position: fixed;
            top: 0;
            left: -15rem;
            min-height: 100vh;
            background: var(--second-bg-color);
            width: 15rem;
            transition: left 0.25s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            color: var(--heading-color);
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

        #wrapper.toggled #page-content-wrapper {
            margin-left: 15rem; /* Ukuran sidebar */
        }

        #menu-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1050;
            cursor: pointer;
            color: var(--toggle-color);
            transition: left 0.3s ease-out;
        }

        #wrapper.toggled #menu-toggle {
            left: calc(27% - 90px);
        }

        /* Semua item menu menggunakan font bold */
        .list-group-item {
            border: none;
            padding: 20px 30px;
            color: var(--second-text-color);
            transition: background-color 0.3s;
            font-family: inherit;
            font-weight: bold;  /* Semua item menggunakan font bold */
            font-size: 1rem;
        }

        /* Menu item yang aktif */
        .list-group-item.active {
            background-color: #f0f0f0;
            color: var(--main-text-color); /* Warna teks aktif diubah menjadi hijau */
            font-weight: bold;
            border: none;
        }

        .list-group-item:hover {
            background-color: rgba(11, 11, 11, 0.1);
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-graduate me-2"></i>Siswa
            </div>
            <div class="list-group list-group-flush my-3">
                <!-- Menu Item Beranda -->
                <a href="{{ route('siswa.beranda') }}" class="list-group-item list-group-item-action bg-transparent second-text {{ Request::routeIs('siswa.beranda') ? 'active' : '' }}">
                    <i class="fas fa-home me-2"></i>Beranda
                </a>

                <!-- Menu Item Profile -->
                <a href="{{ route('siswa.show', Auth::user()->id) }}" class="list-group-item list-group-item-action bg-transparent second-text {{ Request::routeIs('siswa.show') ? 'active' : '' }}">
                    <i class="fas fa-user me-2"></i>Profile
                </a>

                <a href="{{ route('siswa.profil-mitra')}}" class="list-group-item list-group-item-action bg-transparent second-text}">
                    <i class="fas fa-user me-2"></i>Profil Mitra
                </a>

                <!-- Menu Item Absen -->
                <a href="{{ route('siswa.absen') }}" class="list-group-item list-group-item-action bg-transparent second-text {{ Request::routeIs('siswa.absen') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list me-2"></i>Absen
                </a>

                <!-- Menu Item Laporan Harian -->
                <a href="{{ route('siswa.riwayat-kegiatan') }}" class="list-group-item list-group-item-action bg-transparent second-text {{ Request::routeIs('siswa.riwayat-kegiatan') ? 'active' : '' }}">
                    <i class="fas fa-calendar-day me-2"></i>Laporan Harian
                </a>

                <!-- Menu Item Laporan Akhir -->
                <a href="{{ route('laporan.riwayat') }}" class="list-group-item list-group-item-action bg-transparent second-text {{ Request::routeIs('laporan.riwayat') ? 'active' : '' }}">
                    <i class="fas fa-file-alt me-2"></i>Laporan Akhir
                </a>

                <!-- Menu Item Notifikasi -->
                <a href="{{ route('siswa.notifikasi') }}" class="list-group-item list-group-item-action bg-transparent second-text {{ Request::routeIs('siswa.notifikasi') ? 'active' : '' }}">
                    <i class="fas fa-bell me-2"></i>Notifikasi
                </a>

                <!-- Menu Item Logout -->
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-power-off me-2"></i>Keluar
                </a>

                <!-- Form Logout -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                </div>
            </nav>

            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>
