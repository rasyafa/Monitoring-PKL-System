@extends('layouts.admin')

@section('title', 'Laporan Akhir')

@section('page-title', 'Data Laporan Akhir')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2 class="mb-0">Laporan Akhir</h2>
        </div>
        <div class="card-body">
            <!-- Tabel Kegiatan Siswa -->
            <table class="table table-striped table-hover table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.laporan', $student->id) }}" class="btn btn-light-green btn-sm">
                                Lihat laporan akhir {{ $student->name }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .content-container {
        margin-left: 30px;
    }

    .card {
        margin-bottom: 30px;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    /* Tema hijau untuk tabel */
    .table {
        background-color: #f9f9f9;/* Warna latar belakang tabel */
        table-layout: fixed; Kolom memiliki ukuran tetap sesuai lebar
    }

    /* Mengatur lebar tabel agar lebih panjang */
    .table th,
    .table td {
        text-align: center;
        padding: 10px;
        text-overflow: ellipsis; /* Tampilkan tanda titik-titik jika teks terlalu panjang */
        overflow: hidden; /* Sembunyikan teks yang keluar */
    }

    /* Mengatur lebar kolom Nama */
    .table td:nth-child(2),
    .table th:nth-child(2) {
        min-width: 150px; /* Menentukan lebar minimal */
        width: 25%; /* Atur lebar kolom Nama */
    }

    /* Mengatur lebar kolom Aksi */
    .table td:nth-child(3),
    .table th:nth-child(3) {
        width: 30%;
        /* Mengatur kolom Aksi lebih lebar */
    }

    /* Membuat lebar kolom pertama tetap (No) */
    .table td:nth-child(1),
    .table th:nth-child(1) {
        width: 10%;
        /* Lebar kolom No lebih sempit */
    }

    .table th {
        background-color: #32CD32;
        /* Warna latar belakang header tabel */
        color: white;
        /* Warna teks header tabel */
    }

    .table td {
        color: #333;
        /* Warna teks sel tabel */
    }

    .btn-light-green {
        background-color: #3daf58ce;
        /* Warna tombol hijau */
        color: white;
        /* Warna teks tombol */
        padding: 5px 20px; /* Tambahkan ruang horizontal */
        min-width: 150px; /* Pastikan tombol cukup lebar untuk teks */
        white-space: nowrap; /* Teks tetap dalam satu baris */
        text-align: center; /* Teks rata tengah */
    }

    .btn-light-green:hover {
        background-color: #218838;
        /* Warna tombol saat hover */
        color: white;
        /* Warna teks tombol saat hover */
    }

    /* Responsif untuk perangkat kecil */
    @media (max-width: 768px) {
    .btn-light-green {
    font-size: 12px; /* Kecilkan ukuran font untuk layar kecil */
    padding: 5px 10px;
    min-width: 120px; /* Lebar minimum tombol di layar kecil */
    }
    }
</style>
@endpush
