@extends('layouts.siswa')

@section('content')
    <title>Profil Siswa</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            width: 80%;
            max-width: 1200px;
            margin: 5px auto;
            padding: 20px;
        }

        .profile-info {
            border: 1px solid #e0e0e0;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #ffffff;
            width: 50%;
            max-width: 550px;
        }

        .menu-section {
            border: 1px solid #e0e0e0;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            margin-bottom: 20px;
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

        .d-flex {
            display: flex;
            justify-content: space-between;
            gap: 40px;
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .profile-header h3 {
            margin-top: 10px;
        }

        .profile-info {
            margin-top: 20px;
        }

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

        @media (max-width: 992px) {
            .d-flex {
                flex-direction: column;
                align-items: center;
            }

            .col-md-6,
            .col-md-5 {
                width: 100%;
                margin-bottom: 20px;
            }

            .profile-info {
                max-width: 100%;
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

    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <!-- Bagian Kiri: Informasi Pribadi -->
                    <div class="col-md-6 profile-info">
                        <div class="profile-header">
                            <div class="text-center">
                                @if($siswa->profile_photo)
                                    <img src="{{ Storage::url($siswa->profile_photo) }}" alt="Foto Profil" class="profile-photo">
                                @else
                                    <div class="profile-placeholder d-flex align-items-center justify-content-center">
                                        {{ strtoupper(substr($siswa->username, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <h3>{{ $siswa->name }}</h3>
                        </div>

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

                        <div class="text-center mt-4">
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-custom btn-lg ">Edit Profil</a>
                        </div>
                    </div>

                    <!-- Bagian Kanan: Menu -->
                    <div class="col-md-5 mt-5">
                        <div class="menu-section">
                            <h5>Detail Absen</h5>
                            <ul>
                                <li><a href="{{ route('siswa.absen') }}">Lihat Absen</a></li>
                            </ul>
                        </div>

                        <div class="menu-section">
                            <h5>Detail Laporan Harian</h5>
                            <ul>
                                <li><a href="{{ route('siswa.riwayat-kegiatan') }}">Lihat Laporan Harian</a></li>
                            </ul>
                        </div>

                        <div class="menu-section">
                            <h5>Detail Laporan Akhir</h5>
                            <ul>
                                <li><a href="#">Lihat Laporan Akhir</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
