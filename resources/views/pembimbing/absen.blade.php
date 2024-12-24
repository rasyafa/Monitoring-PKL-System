@extends('layouts.pembimbing')

@section('title', 'Data Siswa')

@section('header', 'Data Siswa')

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


    h2 {
        color: #2e7d32;
        /* Hijau */
    }

    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #e8f5e9;
        /* Baris hijau sangat terang */
    }

    .table-bordered thead {
        background-color: #ffffff;
        /* Header tabel putih */
        color: #2e7d32;
        /* Hijau tua untuk teks */
        border-bottom: 2px solid #2e7d32;
        /* Garis bawah header */
    }

    .btn-light-green {
        background-color: #66bb6a;
        /* Hijau cerah */
        color: white;
        border: none;
    }

    .btn-light-green:hover {
        background-color: #4caf50;
        /* Hijau lebih gelap saat hover */
    }

    .btn-danger {
        background-color: #ef5350;
        /* Merah */
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #d32f2f;
        /* Merah lebih gelap saat hover */
    }
</style>

    <div class="container mt-4">
        <h2 class="mb-4">Daftar Absen Siswa</h2>

        <!-- Tabel daftar absen -->
        <table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Waktu</th> <!-- Tambahkan kolom Waktu -->
            <th>Status</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody>
        @foreach($absens as $absen)
        <tr>
            <td>{{ $absen->user->name }}</td>
            <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
<td>{{ \Carbon\Carbon::parse($absen->created_at)->setTimezone('Asia/Jakarta')->format('H:i') }}</td> <!-- Format Waktu -->
            <td>{{ $absen->status }}</td>
            <td>
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
@endsection
