<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Siswa</title>
    <!-- Menambahkan Bootstrap CSS untuk desain -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            width: 100%;
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        /* Kotak informasi pribadi dengan garis tipis */
        .profile-info {
            border: 1px solid #e0e0e0; /* Ubah ke warna abu-abu terang */
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #ffffff;
            width: 100%;
            max-width: 550px;
        }

        /* Kotak menu di sebelah kanan dengan garis tipis */
        .menu-section {
            border: 1px solid #e0e0e0; /* Ubah ke warna abu-abu terang */
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .menu-section h5 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .menu-section ul {
            list-style-type: none;
            padding-left: 0;
        }

        .menu-section a {
            text-decoration: none;
            color: #007bff;
        }

        .menu-section a:hover {
            text-decoration: underline;
        }

        /* Foto Profil dengan lingkaran */
        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .profile-placeholder {
            width: 120px;
            height: 120px;
            background-color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 50px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        /* Container untuk layout flex */
        .d-flex {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .menu-section,
        .profile-info {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        /* Styling tombol dengan warna kustom */
        .btn-custom {
            background-color: #03d703;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #02c102;
            color: white;
        }

        .btn-lg {
            width: 100%;
        }

        /* Responsif untuk perangkat lebih kecil (tablet, ponsel) */
        @media (max-width: 992px) {
            .d-flex {
                flex-direction: column;
                align-items: center;
            }

            .col-md-6,
            .col-md-5 {
                width: 100%;
                /* Lebar 100% di perangkat kecil */
                margin-bottom: 20px;
            }

            .profile-info {
                max-width: 100%;
                /* Memperlebar informasi profil agar lebih responsif */
                padding: 15px;
            }

            .menu-section {
                padding: 12px;
            }

            .profile-photo {
                width: 100px;
                height: 100px;
            }
        }

        @media (max-width: 576px) {
            .btn-lg {
                font-size: 14px;
                padding: 10px;
            }

            .profile-photo {
                width: 80px;
                height: 80px;
            }

            .menu-section h5 {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="d-flex">
                    <!-- Bagian Kiri: Informasi Pribadi -->
                    <div class="col-md-6 profile-info">
                        <!-- Foto Profil -->
                        <div class="text-center">
                            @if($siswa->profile_photo)
                            <img src="{{ Storage::url($siswa->profile_photo) }}" alt="Foto Profil"
                                class="profile-photo">
                            @else
                            <div class="profile-placeholder">
                                {{ strtoupper(substr($siswa->username, 0, 1)) }}
                            </div>
                            @endif
                        </div>

                        <!-- Informasi Profil -->
                        <h3 class="text-center">{{ $siswa->name }}</h3>
                        <p><b>Informasi pribadi</b></p>
                        <div class="mb-2">
                            <strong>Nama pengguna:</strong> <span>{{ $siswa->username }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Email:</strong> <span>{{ $siswa->email }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Kota:</strong> <span>{{ $siswa->city }}</span>
                        </div>

                        <!-- Tombol Edit Profil -->
                        <div class="text-center mt-4">
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-custom btn-lg">Edit Profil</a>
                        </div>
                    </div>

                    <!-- Bagian Kanan: Menu -->
                    <div class="col-md-5 mt-4">
                        <!-- Absen -->
                        <div class="menu-section">
                            <h5>Detail Absen</h5>
                            <ul>
                                <li><a href="{{ route('siswa.absen') }}">Lihat Absen</a></li>
                            </ul>
                        </div>

                        <!-- Kegiatan Harian -->
                        <div class="menu-section">
                            <h5>Detail Kegiatan Harian</h5>
                            <ul>
                                <li><a href="{{ route('siswa.riwayat-kegiatan') }}">Lihat Kegiatan Harian</a></li>
                            </ul>
                        </div>

                        <!-- Nilai Akhir -->
                        <div class="menu-section">
                            <h5>Detail Nilai Akhir</h5>
                            <ul>
                                <li><a href="#">Lihat Nilai</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menambahkan Bootstrap JS untuk interaksi jika diperlukan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
