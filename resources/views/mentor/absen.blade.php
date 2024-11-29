@extends('layouts.mentor')

@section('title', 'Data Siswa')

@section('header', 'Data Siswa')

@section('content')
<style>
    .btn-secondary-custom {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }

    .btn-secondary-custom:hover {
        background-color: #5a6268;
        border-color: #5a6268;
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
                <th>Waktu Input</th>
                <th>Status</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absens as $absen)
            <tr>
                <td>{{ $absen->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
                <td>
                    <!-- Menampilkan waktu input -->
                    {{ \Carbon\Carbon::parse($absen->created_at)->format('H:i:s') }}
                </td>
                <td>{{ $absen->status }}</td>
                <td>
                    @if ($absen->foto)
                    <img src="{{ asset('storage/' .$absen->foto) }}" alt="Foto Absen" width="100">
                    @else
                    Tidak ada foto
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Tombol Tambah dan kembali -->
    {{-- <div class="btn-container">
        <a href="{{ route('mentor.beranda') }}" class="btn btn-secondary-custom">Kembali</a>
    </div> --}}
</div>
@endsection
