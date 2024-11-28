@extends('layouts.admin')

@section('content')
<h1>Daftar Mitra</h1>

<a href="{{ route('admin.mitra.create') }}" class="btn btn-primary">Tambah Mitra Baru</a>

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
                <!-- Aksi edit dan hapus bisa ditambahkan di sini -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
