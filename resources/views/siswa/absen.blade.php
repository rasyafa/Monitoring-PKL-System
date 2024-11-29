@extends('layouts.siswa') <!-- Menggunakan layout siswa yang sudah didefinisikan sebelumnya -->

@section('content') <!-- Menandai awal konten halaman ini -->

    <title>Absen Hari Ini</title> <!-- Mengatur judul halaman menjadi "Absen Hari Ini" -->

    <style>
        /* Menyusun latar belakang halaman dengan warna abu-abu muda */
        body {
            background-color: #f4f6f9;
        }

        /* Menambahkan border radius pada card agar tampil lebih modern */
        .card {
            border-radius: 10px;
        }

        /* Styling tombol kembali yang memiliki latar belakang abu-abu */
        .btn-back {
            background-color: #6c757d;
            color: white;
        }

        /* Efek hover untuk tombol kembali yang berubah menjadi abu-abu gelap */
        .btn-back:hover {
            background-color: #5a6268;
        }

        /* Menyusun tabel agar elemen header dan kolomnya vertikal di tengah */
        .table th,
        .table td {
            vertical-align: middle;
        }

        /* Styling header card dengan latar belakang hijau dan teks berwarna putih */
        .card-header {
            background-color: #03d703;
            color: white;
            text-align: center;
            font-size: 1.25rem;
        }

        /* Styling untuk alert (notifikasi sukses atau error) dengan border radius */
        .alert {
            border-radius: 10px;
        }

        /* Styling tombol absensi dengan latar belakang hijau */
        .btn-absen {
            background-color: #03d703;
            color: white;
            border: none;
        }

        /* Efek hover pada tombol absensi yang berubah menjadi hijau lebih gelap */
        .btn-absen:hover {
            background-color: #029b02;
        }

        /* Styling untuk input radio button (untuk status kehadiran) */
        .form-check-input {
            appearance: none;
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            position: relative;
            transition: all 0.2s ease;
        }

        /* Styling untuk input radio yang sudah dipilih */
        .form-check-input:checked {
            background-color: #03d703;
            border-color: #03d703;
        }

        /* Styling untuk tampilan ceklis pada radio button yang dipilih */
        .form-check-input:checked::after {
            content: '';
            position: absolute;
            top: 4px;
            left: 4px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: white;
        }

        /* Styling untuk label status kehadiran */
        .form-check-label {
            color: #333;
            font-size: 1rem;
            margin-left: 10px;
            transition: color 0.2s ease;
        }

        /* Menambahkan warna hijau pada label yang terkait dengan input radio yang dipilih */
        .form-check-input:checked+.form-check-label {
            color: #03d703;
        }

        /* Styling untuk menata status kehadiran dengan jarak antar pilihan radio */
        .status-kehadiran {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        /* Menyusun pilihan status kehadiran menjadi inline */
        .status-kehadiran .form-check {
            display: inline-block;
        }
    </style>

    <div class="container mt-4">
        <!-- Menampilkan pesan sukses jika ada session 'success' -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Menampilkan pesan umum jika ada session 'message' -->
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <!-- Menampilkan pesan error jika ada error -->
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <!-- Form untuk absensi hari ini -->
        <div class="card shadow-lg p-4 mb-5">
            <div class="card-header">
                <h4>Absen Hari Ini</h4>
            </div>
            <!-- Form untuk mengirim data absensi -->
            <form action="{{ route('siswa.absen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- CSRF token untuk keamanan form -->

                <!-- Input untuk nama siswa, sudah terisi otomatis dari user yang login -->
                <div class="mb-3">
                    <label for="user_name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="user_name" value="{{ auth()->user()->name }}" disabled>
                </div>

                <!-- Input untuk tanggal, diset otomatis menjadi tanggal hari ini -->
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ now()->toDateString() }}" disabled>
                </div>

                <!-- Input untuk mengirimkan foto absensi -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Kirim Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                </div>

                <!-- Pilihan status kehadiran -->
                <div class="mb-3">
                    <label class="form-label">Status Kehadiran</label>
                    <div class="status-kehadiran">
                        <!-- Pilihan radio untuk hadir -->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="hadir" value="Hadir">
                            <label class="form-check-label" for="hadir">Hadir</label>
                        </div>
                        <!-- Pilihan radio untuk sakit -->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="sakit" value="Sakit">
                            <label class="form-check-label" for="sakit">Sakit</label>
                        </div>
                        <!-- Pilihan radio untuk izin -->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="izin" value="Izin">
                            <label class="form-check-label" for="izin">Izin</label>
                        </div>
                        <!-- Pilihan radio untuk alpha -->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="alpha" value="Alpha">
                            <label class="form-check-label" for="alpha">Alpha</label>
                        </div>
                    </div>
                </div>

                <!-- Tombol untuk mengirimkan absensi -->
                <button type="submit" class="btn btn-absen me-2">Absen</button>
            </form>
        </div>

        <!-- Riwayat absen -->
        <h4 class="mb-4">Riwayat Absen</h4>
        <div class="card shadow-sm p-3">
            <!-- Tabel untuk menampilkan riwayat absen -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Foto</th> <!-- Menampilkan kolom untuk foto -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping untuk menampilkan riwayat absen -->
                    @foreach ($absens as $absen)
                    <tr>
                        <td>{{ $absen->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $absen->status }}</td>
                        <td>
                            <!-- Menampilkan foto absen jika ada -->
                            @if ($absen->foto)
                                <img src="{{ asset('storage/' . $absen->foto) }}" alt="Foto Absen" width="100">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Memuat script Bootstrap untuk mendukung interaktivitas di halaman -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
@endsection <!-- Menandai akhir dari konten halaman ini -->
