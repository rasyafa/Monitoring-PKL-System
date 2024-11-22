@extends('layouts.pembimbing')

@section('title', 'Laporan Akhir')

@section('page-title', 'Laporan Akhir')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Card untuk semua laporan -->
        <div class="col-md-12">
            <div class="card" style="border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <!-- Judul -->
                    <h3 class="text-center mb-4" style="color: #03d703;">Laporan Akhir</h3>

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
    :root {
        --main-bg-color: #03d703; /* Warna utama untuk background */
        --main-text-color: #03d703; /* Warna utama untuk teks */
        --second-text-color: #686868; /* Warna teks sekunder */
        --second-bg-color: #ffffff; /* Warna background sekunder */
        --toggle-color: #03d703; /* Warna untuk elemen yang bisa diaktifkan */
        --heading-color: #03d703; /* Warna judul */
        --border-color: rgba(0, 0, 0, 0.1); /* Warna border */
    }

    body {
        background-color: var(--second-bg-color);
        color: var(--second-text-color);
        font-family: Arial, sans-serif;
    }

    h3 {
        font-weight: bold;
        color: var(--heading-color);
    }

    .table th {
        background-color: var(--main-bg-color);
        color: white;
        text-align: left;
    }

    .table td {
        color: var(--second-text-color);
        text-align: left;
    }

    .btn-outline-success {
        color: var(--main-text-color);
        border-color: var(--main-text-color);
    }

    .btn-outline-success:hover {
        background-color: var(--main-text-color);
        color: white;
    }

    .card {
        margin-bottom: 20px;
        background-color: var(--second-bg-color);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        box-shadow: 0 2px 4px var(--border-color);
    }

    .card-body {
        padding: 20px;
    }

    .text-center {
        color: var(--main-text-color);
    }

    .text-muted {
        color: var(--second-text-color);
    }

    .container {
        padding: 20px;
    }

    /* Tambahkan gaya untuk tabel */
    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table-bordered {
        border: 1px solid var(--border-color);
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid var(--border-color);
    }

    /* Mengatasi masalah border di tabel */
    .table-bordered {
        border: 1px solid #ddd !important;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ddd !important;
    }
</style>

@endsection
