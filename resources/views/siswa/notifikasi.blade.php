@extends('layouts.siswa') <!-- Menggunakan layout 'siswa' sebagai template utama -->

@section('title', 'Notifikasi Harian') <!-- Menentukan judul halaman di tab browser -->

@section('content') <!-- Memulai bagian konten halaman yang akan dimasukkan ke dalam layout -->

<div class="container-fluid px-4"> <!-- Membungkus konten dalam container dengan padding horizontal tambahan -->
    <div class="card shadow mx-auto mt-3 w-90"> <!-- Card utama dengan bayangan dan margin otomatis untuk penataan -->
        <div class="card-body">
            <!-- Menampilkan pesan sambutan dengan nama pengguna -->
            <h4 class="mb-4">Hallo👋, {{ $user->name }}!</h4>

            <!-- Pengingat Absen -->
            <div class="card custom-bg-gray mb-3"> <!-- Card dengan latar belakang abu-abu untuk pengingat absen -->
                <div class="card-body">
                    <h5>Pengingat Absen</h5>
                    @if ($absen)
                        <!-- Jika sudah absen, tampilkan status absen -->
                        <p class="text-success">Anda sudah absen hari ini. Status: <strong>{{ $absen->status }}</strong></p>
                    @else
                        <!-- Jika belum absen, tampilkan pesan pemberitahuan dan tombol absen -->
                        <p class="text-danger"><strong>Anda belum melakukan absen hari ini!</strong></p>
                        <a href="{{ route('siswa.absen') }}" class="btn" style="background-color: #009c00; color: white;">Klik di sini untuk absen</a>
                    @endif
                </div>
            </div>

            <!-- Pengingat Laporan Harian -->
            <div class="card custom-bg-gray"> <!-- Card dengan latar belakang abu-abu untuk pengingat laporan harian -->
                <div class="card-body">
                    <h5>Pengingat Laporan Harian</h5>
                    @if ($laporanHarian->isEmpty())
                        <!-- Jika belum mengisi laporan harian, tampilkan pemberitahuan dan tombol untuk mengisi laporan -->
                        <p class="text-danger">
                            <strong>Anda belum mengisi laporan harian untuk tanggal {{ $tanggalHariIni->format('d-m-Y') }}.</strong>
                        </p>
                        <a href="{{ route('siswa.riwayat-kegiatan') }}" class="btn" style="background-color: #009c00; color: white;">Klik di sini untuk mengisi laporan harian</a>
                    @else
                        <!-- Jika sudah mengisi laporan harian, tampilkan daftar laporan yang sudah diisi -->
                        <p class="text-success">Anda sudah mengisi laporan harian:</p>
                        <ul class="list-group">
                            @foreach ($laporanHarian as $laporan)
                                <li class="list-group-item">
                                    <strong>Kegiatan:</strong> {{ $laporan->kegiatan }} <br>
                                    <strong>Waktu:</strong> {{ $laporan->waktu_mulai }} - {{ $laporan->waktu_selesai }} <br>
                                    <!-- Menampilkan status laporan dengan badge sesuai status laporan -->
                                    <span class="badge bg-{{ $laporan->status == 'acc' ? 'success' : 'danger' }}">{{ $laporan->status }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection <!-- Menandakan akhir dari bagian konten yang dimasukkan ke dalam layout -->

@push('styles') <!-- Menambahkan gaya kustom di bagian 'styles' -->
    <style>
        /* CSS Kustom untuk warna hijau kuat */
        .custom-bg-dark-green {
            background-color: #009c00; /* Hijau lebih kuat */
        }

        /* CSS Kustom untuk warna hijau gelap terang */
        .custom-bg-light-dark-green {
            background-color: #66cc66; /* Hijau gelap terang */
        }

        /* CSS Kustom untuk warna abu-abu pada card */
        .custom-bg-gray {
            background-color: #e22222; /* Abu-abu terang */
        }
    </style>
@endpush <!-- Mengakhiri bagian 'styles' -->
