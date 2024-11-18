<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Dashboard Mentor')</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Custom CSS Styles */
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
        }

        #page-content-wrapper {
            width: 100%;
            margin-left: 20rem;
            padding: 20px;
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

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #fff;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-chalkboard-teacher me-2"></i>Mentor
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="{{ route('mentor.beranda') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-home me-2"></i>Beranda</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-user me-2"></i>Profil</a>
                <a class="list-group-item list-group-item-action bg-transparent second-text fw-bold dropdown-toggle"
                    data-bs-toggle="collapse" href="#manageUsersDropdown" role="button" aria-expanded="false"
                    aria-controls="manageUsersDropdown">
                    <i class="fas fa-users me-2"></i>Siswa
                </a>
                <div class="collapse" id="manageUsersDropdown">
                    <ul class="list-group list-group-flush ms-3">
                        <li><a href="{{ route('mentor.datasiswa') }}" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-user-graduate me-2"></i>Data</a></li>
                        <li><a href="{{ route('mentor.absen') }}" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-chalkboard-teacher me-2"></i>Absen</a></li>
                        <li><a href="{{ route('mentor.kegiatan') }}" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-handshake me-2"></i>Kegiatan Harian</a></li>
                        <li><a href="#" class="list-group-item list-group-item-action bg-transparent second-text">
                                <i class="fas fa-user-tie me-2"></i>Nilai</a></li>
                    </ul>
                </div>
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

        <!-- Main Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2>@yield('header', 'Dashboard')</h2>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    @stack('scripts')
</body>

</html>
