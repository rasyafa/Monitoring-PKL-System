@extends('layouts.pembimbing')

@section('title', 'Laporan Akhir')

@section('page-title', 'Data Laporan Akhir')

@section('content')

<style>
    :root {
            --main-bg-color: #03d703;
            --main-text-color: #03d703;
            --second-text-color: #686868;
            --second-bg-color: #fff;
            --toggle-color: #03d703;
            --heading-color: #03d703;
        }

    .content-container {
        margin-left: 30px;
        
    }

    .card {
        margin-bottom: 30px;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        color: #32CD32;
    }

    /* Tema hijau untuk tabel */
    .table {
        background-color: #f9f9f9;
        /* Warna latar belakang tabel */
    }

    /* Mengatur lebar tabel agar lebih panjang */
    .table th,
    .table td {
        text-align: center;
        padding: 10px;
    }

    /* Mengatur lebar kolom Nama */
    .table td:nth-child(2),
    .table th:nth-child(2) {
        width: 40%;
        /* Mengatur kolom Nama lebih lebar */
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
    }

    .btn-light-green:hover {
        background-color: #218838;
        /* Warna tombol saat hover */
        color: white;
        /* Warna teks tombol saat hover */
    }
</style>


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
                            <a href="{{ route('pembimbing.laporanakhir', $student->id) }}" class="btn btn-light-green btn-sm">
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