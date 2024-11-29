@extends('layouts.admin')

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
                                <th>{{ $students->name }}</th>
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
                                    </a>
                                </th>
                            </tr>
                           
                            <tr style="background-color: #fafafa;">
                                <th><strong>Link Laporan</strong></th>
                                <th>
                                    <!-- Link eksternal ke laporan jika ada -->
                                    <a href="{{ $laporan->link_laporan }}" target="_blank" class="btn btn-link">
                                        {{ basename($laporan->link_laporan) }}
                                    </a>
                                </th>
                            </tr>

                            <tr style="background-color: #f7f7f7;">
                                <th><strong>Status</strong></th>
                                <th>
                                    @if($laporan->status == 'acc')
                                    <span class="text-success">Sudah Diterima (ACC)</span>
                                    @elseif($laporan->status == 'revisi')
                                    <span class="text-danger">Perlu Revisi</span>
                                    @else
                                    <span class="text-warning">Menunggu Validasi</span>
                                    @endif
                                </th>
                            </tr>
                            <tr style="background-color: #fafafa;">
                                <th><strong>Catatan</strong></th>
                                <th>
                                    @if($laporan->catatan)
                                    {{ $laporan->catatan }}
                                    @else
                                    <span class="text-muted">Tidak ada catatan</span>
                                    @endif
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

    .table {
    background-color: #f9f9f9;/* Warna latar belakang tabel */
    table-layout: fixed; Kolom memiliki ukuran tetap sesuai lebar

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
