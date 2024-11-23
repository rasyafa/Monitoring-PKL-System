<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Sistem PKL</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }


        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #000000; /* Mengubah warna navbar-brand menjadi hitam */
        }

        .navbar-light .navbar-nav .nav-link {
            color: #000000; /* Mengubah warna teks link navbar menjadi hitam */
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #333333; /* Mengubah warna teks link navbar saat hover menjadi lebih gelap */
        }




        .feature-icon {
            font-size: 3rem;
            color: #30ed30;
        }

        .feature-box {
            background-color: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 15px;
        }


        /* css untuk button mulai sekarang */
        .cta-button {
            font-size: 1.125rem;
            padding: 12px 24px;
            border-radius: 15px;
            background-color: #30ed30;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #2aa92a;
        }

        /* css untuk button register */
        .btn-success{
            background-color: #30ed30;

        }

        .btn-success:hover{
            background-color: #2aa92a;
        }

        .footer {
            background-color: #ffffff;
            padding: 20px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .footer p {
            color: #000000;
        }
    </style>
</head>

<body>

    <div class="min-vh-100 d-flex flex-column">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Sistem PKL</a>
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-success me-3">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-success">Daftar</a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container pt-5 pb-5 mt-5">
            <div class="text-center">
                <h1 class="display-5 text-dark mb-4 font-weight-bold" style="font-weight: bold;">
                Selamat Datang di Sistem PKL
                </h1>
                <p class="lead text-muted mb-5">
                    Platform manajemen Praktik Kerja Lapangan yang memudahkan siswa, pembimbing, mitra, dan mentor.
                </p>

                <!-- Features Grid -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <!-- Feature 1: Siswa -->
                    <div class="col">
                        <div class="feature-box text-center">
                            <div class="feature-icon">👨‍🎓</div>
                            <h3 class="feature-title">Siswa</h3>
                            <p class="text-muted">Kelola pengajuan dan laporan PKL dengan mudah</p>
                        </div>
                    </div>

                    <!-- Feature 2: Pembimbing -->
                    <div class="col">
                        <div class="feature-box text-center">
                            <div class="feature-icon">👨‍🏫</div>
                            <h3 class="feature-title">Pembimbing</h3>
                            <p class="text-muted">Monitoring dan evaluasi progress siswa</p>
                        </div>
                    </div>

                    <!-- Feature 3: Mitra -->
                    <div class="col">
                        <div class="feature-box text-center">
                            <div class="feature-icon">🏢</div>
                            <h3 class="feature-title">Mitra</h3>
                            <p class="text-muted">Kelola program PKL dan peserta magang</p>
                        </div>
                    </div>

                    <!-- Feature 4: Mentor -->
                    <div class="col">
                        <div class="feature-box text-center">
                            <div class="feature-icon">👨‍💼</div>
                            <h3 class="feature-title">Mentor</h3>
                            <p class="text-muted">Bimbingan dan evaluasi langsung di tempat PKL</p>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="mt-5">
                    <a href="{{ route('register') }}" class="cta-button">Mulai Sekarang</a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer mt-auto">
            <div class="container text-center text-muted">
                <p>© {{ date('Y') }} Sistem PKL. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS (Optional but necessary for some Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
