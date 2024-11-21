@extends('layouts.siswa')

@section('title', 'Notifikasi Harian')

@section('content')
<div class="container-fluid px-4"> <!-- Menambahkan padding horizontal dengan kelas px-4 -->
    <div class="card shadow mx-auto mt-3 w-90">

        <div class="card-body">
            <h4 class="mb-4">Hallo👋, {{ $user->name }}!</h4>

            <!-- Pengingat Absen - Card dengan latar belakang abu-abu -->
            <div class="card custom-bg-gray mb-3">
                <div class="card-body">
                    <h5>Pengingat Absen</h5>
                    @if ($absen)
                        <p class="text-success">Anda sudah absen hari ini. Status: <strong>{{ $absen->status }}</strong></p>
                    @else
                        <p class="text-danger"><strong>Anda belum melakukan absen hari ini!</strong></p>
                        <a href="{{ route('siswa.absen') }}" class="btn" style="background-color: #009c00; color: white;">Klik di sini untuk absen</a>
                    @endif
                </div>
            </div>

            <!-- Pengingat Laporan Harian - Card dengan latar belakang abu-abu -->
            <div class="card custom-bg-gray">
                <div class="card-body">
                    <h5>Pengingat Laporan Harian</h5>
                    @if ($laporanHarian->isEmpty())
                        <p class="text-danger">
                            <strong>Anda belum mengisi laporan harian untuk tanggal {{ $tanggalHariIni->format('d-m-Y') }}.</strong>
                        </p>
                        <!-- Ubah button ini untuk memakai warna yang sama dengan button Absen -->
                        <a href="{{ route('siswa.riwayat-kegiatan') }}" class="btn" style="background-color: #009c00; color: white;">Klik di sini untuk mengisi laporan harian</a>
                    @else
                        <p class="text-success">Anda sudah mengisi laporan harian:</p>
                        <ul class="list-group">
                            @foreach ($laporanHarian as $laporan)
                                <li class="list-group-item">
                                    <strong>Kegiatan:</strong> {{ $laporan->kegiatan }} <br>
                                    <strong>Waktu:</strong> {{ $laporan->waktu_mulai }} - {{ $laporan->waktu_selesai }} <br>
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
@endsection

@push('styles')
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
@endpush
