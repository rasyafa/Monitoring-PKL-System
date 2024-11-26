@extends('layouts.siswa')

@section('content')

<!-- Title halaman -->
<title>Absen Hari Ini</title>

<!-- Styling untuk halaman -->
<style>
    body {
        background-color: #f4f6f9;
        /* Warna latar belakang */
    }

    .card {
        border-radius: 10px;
        /* Membulatkan sudut kartu */
    }

    .btn-back {
        background-color: #6c757d;
        /* Warna tombol kembali */
        color: white;
    }

    .btn-back:hover {
        background-color: #5a6268;
        /* Warna tombol kembali saat hover */
    }

    .table th,
    .table td {
        vertical-align: middle;
        /* Menyelaraskan isi tabel di tengah */
    }

    .card-header {
        background-color: #03d703;
        /* Warna header kartu */
        color: white;
        /* Warna teks header kartu */
        text-align: center;
        /* Teks di tengah */
        font-size: 1.25rem;
        /* Ukuran font header */
    }

    .alert {
        border-radius: 10px;
        /* Membulatkan sudut alert */
    }

    .btn-absen {
        background-color: #03d703;
        /* Warna tombol absen */
        color: white;
        /* Warna teks tombol */
        border: none;
        /* Menghilangkan border tombol */
    }

    .btn-absen:hover {
        background-color: #029b02;
        /* Warna tombol saat hover */
    }

    /* Styling untuk radio button */
    .form-check-input {
        appearance: none;
        /* Menyembunyikan tampilan default */
        background-color: #fff;
        /* Warna latar */
        border: 2px solid #ddd;
        /* Border radio button */
        border-radius: 50%;
        /* Membulatkan radio button */
        width: 20px;
        height: 20px;
        position: relative;
        transition: all 0.2s ease;
        /* Animasi transisi */
    }

    .form-check-input:checked {
        background-color: #03d703;
        /* Warna jika dipilih */
        border-color: #03d703;
        /* Warna border */
    }

    .form-check-input:checked::after {
        content: '';
        /* Simbol dalam radio button */
        position: absolute;
        top: 4px;
        left: 4px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        /* Membulatkan simbol */
        background-color: white;
        /* Warna simbol */
    }

    .form-check-label {
        color: #333;
        /* Warna label */
        font-size: 1rem;
        /* Ukuran font label */
        margin-left: 10px;
        /* Jarak dengan radio button */
        transition: color 0.2s ease;
        /* Animasi perubahan warna */
    }

    .form-check-input:checked+.form-check-label {
        color: #03d703;
        /* Warna label saat dipilih */
    }

    .status-kehadiran {
        display: flex;
        gap: 20px;
        /* Jarak antar pilihan */
        align-items: center;
    }

    .status-kehadiran .form-check {
        display: inline-block;
        /* Menampilkan inline */
    }
</style>

<div class="container mt-4">

    <!-- Pesan sukses jika berhasil -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Pesan sukses atau error lainnya -->
    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <!-- Menampilkan pesan error -->
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <!-- Form Absen -->
    <div class="card shadow-lg p-4 mb-5">
        <div class="card-header">
            <h4>Absen Hari Ini</h4>
        </div>
        <form action="{{ route('siswa.absen.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_name" class="form-label">Nama</label>
                <!-- Menampilkan nama pengguna yang login -->
                <input type="text" class="form-control" id="user_name" value="{{ auth()->user()->name }}" disabled>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <!-- Menampilkan tanggal saat ini -->
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ now()->toDateString() }}"
                    disabled>
            </div>

            <!-- Pilihan status kehadiran -->
            <div class="mb-3">
                <label class="form-label">Status Kehadiran</label>
                <div class="status-kehadiran">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="hadir" value="Hadir" checked>
                        <label class="form-check-label" for="hadir">
                            Hadir
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="sakit" value="Sakit">
                        <label class="form-check-label" for="sakit">
                            Sakit
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="izin" value="Izin">
                        <label class="form-check-label" for="izin">
                            Izin
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="alpha" value="Alpha">
                        <label class="form-check-label" for="alpha">
                            Alpha
                        </label>
                    </div>
                </div>
            </div>

            <!-- Tombol submit -->
            <button type="submit" class="btn btn-absen me-2">Absen</button>
        </form>
    </div>

    <!-- Riwayat Absen -->
    <h4 class="mb-4">Riwayat Absen</h4>
    <div class="card shadow-sm p-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Menampilkan data riwayat absen -->
                @foreach ($absens as $absen)
                <tr>
                    <td>{{ $absen->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $absen->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
