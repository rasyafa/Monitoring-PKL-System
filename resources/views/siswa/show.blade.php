@extends('layouts.siswa') <!-- Menggunakan layout 'siswa' sebagai template utama -->

@section('content') <!-- Memulai bagian konten halaman yang akan dimasukkan ke dalam layout -->

<title>Profil Siswa</title> <!-- Menentukan judul halaman di tab browser -->

<style>
    /* Mengatur warna latar belakang halaman */
    body {
        background-color: #f8f9fa;
    }

    /* Penataan untuk card utama dengan margin, padding, dan lebar yang ditentukan */
    .card {
        width: 80%;
        max-width: 1200px;
        margin: 5px auto;
        padding: 20px;
    }

    /* Penataan untuk informasi profil siswa (gambar dan data pribadi) */
    .profile-info {
        border: 1px solid #e0e0e0;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        background-color: #ffffff;
        width: 50%;
        max-width: 550px;
    }

    /* Penataan untuk setiap menu bagian kanan */
    .menu-section {
        border: 1px solid #e0e0e0;
        padding: 15px;
        background-color: white;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    /* Pengaturan gaya untuk judul dalam menu */
    .menu-section h5 {
        font-weight: bold;
        margin-bottom: 10px;
    }

    /* Penataan untuk list menu */
    .menu-section ul {
        list-style-type: none;
        padding-left: 0;
    }

    /* Gaya untuk tautan pada menu */
    .menu-section a {
        text-decoration: none;
        color: #007bff;
    }

    /* Efek hover untuk tautan */
    .menu-section a:hover {
        text-decoration: underline;
    }

    /* Penataan untuk gambar profil dengan bentuk lingkaran */
    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
    }

    /* Gaya untuk placeholder gambar profil ketika tidak ada foto */
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

    /* Flexbox untuk layout dengan dua kolom (kiri dan kanan) */
    .d-flex {
        display: flex;
        justify-content: space-between;
        gap: 40px;
    }

    /* Penataan untuk header profil */
    .profile-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    /* Penataan untuk judul nama di bagian header profil */
    .profile-header h3 {
        margin-top: 10px;
    }

    /* Penataan untuk informasi profil di bawah nama siswa */
    .profile-info {
        margin-top: 20px;
    }

    /* Gaya untuk tombol dengan warna hijau */
    .btn-custom {
        background-color: #03d703;
        color: white;
        border: none;
    }

    /* Efek hover pada tombol */
    .btn-custom:hover {
        background-color: #02c102;
        color: white;
    }

    /* Gaya untuk tombol ukuran besar */
    .btn-lg {
        width: 100%;
    }

    /* Responsif untuk layar dengan lebar maksimal 992px */
    @media (max-width: 992px) {
        .d-flex {
            flex-direction: column;
            align-items: center;
        }

        /* Mengatur lebar kolom agar lebih kecil pada layar kecil */
        .col-md-6,
        .col-md-5 {
            width: 100%;
            margin-bottom: 20px;
        }

        /* Menyesuaikan ukuran dan padding pada informasi profil dan menu */
        .profile-info {
            max-width: 100%;
            padding: 15px;
        }

        .menu-section {
            padding: 12px;
        }

        /* Menyesuaikan ukuran foto profil pada layar kecil */
        .profile-photo {
            width: 100px;
            height: 100px;
        }
    }

    /* Responsif untuk layar dengan lebar maksimal 576px */
    @media (max-width: 576px) {
        /* Menyesuaikan ukuran tombol */
        .btn-lg {
            font-size: 14px;
            padding: 10px;
        }

        /* Mengurangi ukuran gambar profil lebih kecil di layar sangat kecil */
        .profile-photo {
            width: 80px;
            height: 80px;
        }

        /* Menyesuaikan ukuran font pada judul menu */
        .menu-section h5 {
            font-size: 16px;
        }
    }
</style>

<div class="container">
    <!-- Card utama untuk menampilkan profil siswa -->
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <!-- Bagian Kiri: Informasi Pribadi Siswa -->
                <div class="col-md-6 profile-info">
                    <div class="profile-header">
                        <div class="text-center">
                            <!-- Menampilkan foto profil siswa atau placeholder jika tidak ada foto -->
                            @if($siswa->profile_photo)
                                <img src="{{ Storage::url($siswa->profile_photo) }}" alt="Foto Profil" class="profile-photo">
                            @else
                                <div class="profile-placeholder d-flex align-items-center justify-content-center">
                                    {{ strtoupper(substr($siswa->username, 0, 1)) }} <!-- Mengambil huruf pertama dari username sebagai inisial -->
                                </div>
                            @endif
                        </div>
                        <!-- Nama lengkap siswa -->
                        <h3>{{ $siswa->name }}</h3>
                    </div>

                    <!-- Menampilkan informasi pribadi siswa -->
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

                    <!-- Tombol untuk mengedit profil -->
                    <div class="text-center mt-4">
                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-custom btn-lg ">Edit Profil</a>
                    </div>
                </div>

                <!-- Bagian Kanan: Menu dengan tautan ke halaman lain -->
                <div class="col-md-5 mt-5">
                    <!-- Menu Absen -->
                    <div class="menu-section">
                        <h5>Detail Mitra</h5>
                        <ul>
                            <li><a href="{{ route('siswa.profil-mitra')}}">Lihat Mitra</a></li>
                        </ul>
                    </div>

                    <!-- Menu Laporan Harian -->
                    <div class="menu-section">
                        <h5>Detail Absen</h5>
                        <ul>
                            <li><a href="{{ route('siswa.absen') }}">Lihat Absen</a></li>
                        </ul>
                    </div>

                    <!-- Menu Laporan Akhir -->
                    <div class="menu-section">
                        <h5>Detail Laporan Harian</h5>
                        <ul>
                            <li><a href="{{ route('siswa.riwayat-kegiatan') }}">Lihat Laporan Harian</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection <!-- Menandakan akhir dari bagian konten yang dimasukkan ke dalam layout -->
