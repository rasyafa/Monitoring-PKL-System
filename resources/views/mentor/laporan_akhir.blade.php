@extends('layouts.mentor')

@section('title', 'Laporan Akhir')

@section('page-title', 'Laporan Akhir')

@section('content')
<div class="container mt-4">

    <div class="row">
        <!-- Card untuk semua laporan -->
        <div class="col-md-12 mb-4">
            <div class="card" style="border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <!-- Judul Laporan Akhir -->
                    <h3 class="text-center mb-4">Laporan Akhir {{ $students->name }}</h3>

                    <!-- Cek jika ada laporan -->
                    @forelse($laporans as $laporan)
                    <table class="table table-bordered" style="border-radius: 10px;">
                        <thead>
                            <tr style="background-color: #f7f7f7;">
                                <th><strong>Nama</strong></th>
                                <th>{{ Auth::user()->name }}</th>
                            </tr>
                            <tr style="background-color: #fafafa;">
                                <th><strong>Tanggal</strong></th>
                                <th>{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d-m-Y') }}</th>
                            </tr>
                            <tr style="background-color: #f7f7f7;">
                                <th><strong>Judul Laporan</strong></th>
                                <th>{{ $laporan->judul }}</th>
                            </tr>
                            <tr style="background-color: #fafafa;">
                                <th><strong>File</strong></th>
                                <th>
                                    <!-- Link to the file with the original file name -->
                                    <a href="{{ Storage::url($laporan->file_path) }}" class="btn btn-link"
                                        target="_blank">
                                        {{ basename($laporan->file_path) }}
                                        <!-- Display the original file name -->
                                    </a>
                                </th>
                            </tr>

                        </thead>
                    </table>
                    @empty
                    <p class="text-center">Belum ada laporan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan gaya khusus -->
<style>
    /* Ubah warna tombol menjadi #03d703 */
    button.btn-primary {
        background-color: #03d703 !important;
        border-color: #03d703 !important;
    }

    /* Ubah warna teks laporan terkirim menjadi abu-abu */
    .table th,
    .table td {
        color: #6c757d !important;
        /* Abu-abu */
    }

    /* Tambahkan jarak antar elemen */
    .table th,
    .table td {
        padding: 15px !important;
        /* Tambah jarak */
    }
</style>
@endsection
