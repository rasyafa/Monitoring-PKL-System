@extends('layouts.admin')

@section('content')
<h1>Daftar Mitra</h1>

<a href="{{ route('admin.mitra.create') }}" class="btn btn-custom-green">Tambah Mitra Baru</a>

<table class="table">
    <thead>
        <tr>
            <th>Nama Perusahaan</th>
            <th>Bidang Usaha</th>
            <th>Nama Pimpinan</th>
            <th>Mentor</th>
            <th>Pembimbing</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mitras as $mitra)
        <tr>
            <td>{{ $mitra->nama_perusahaan }}</td>
            <td>{{ $mitra->bidang_usaha }}</td>
            <td>{{ $mitra->nama_pimpinan }}</td>
            <td>
                @foreach ($mitra->mentors as $mentor)
                <span>{{ $mentor->name }}</span><br>
                @endforeach
            </td>
            <td>
                @foreach ($mitra->pembimbings as $pembimbing)
                <span>{{ $pembimbing->name }}</span><br>
                @endforeach
            </td>
            <td>
                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                <form action="#" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('styles')
<style>

    .btn-custom-green {
    background-color: #2bcf51; /* Warna hijau */
    border: none;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    }

    /* Efek hover pada tombol */
    .btn-custom-green:hover {
    background-color: #19a938; /* Warna hijau lebih gelap saat hover */
    box-shadow: 0 4px 8px rgba(0, 128, 0, 0.3);
    }
    /* Styling untuk card */
    .card {
    background-color: #ffffff; /* Latar belakang putih pada card */
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Bayangan lembut pada card */
    padding: 20px;
    }

    /* Styling untuk tombol tambah mitra */
    .card-body a.btn-primary {
    background-color: #28a745; /* Warna hijau untuk tombol */
    color: white;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    }

    .card-body a.btn-primary:hover {
    background-color: #218838; /* Warna lebih gelap saat hover */
    }

    /* Styling untuk tabel di dalam card */
    .table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    }

    .table th, .table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
    }

    .table th {
    background-color: #f8f9fa;
    }

    .table tbody tr:hover {
    background-color: #f1f1f1;
    }
</style>

@endpush
