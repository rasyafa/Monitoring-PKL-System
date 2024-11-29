@extends('layouts.siswa')

@section('content')

<h2 class="mb-4 text-center">Detail Mitra Anda</h2>

@if($mitra)
<div class="card shadow col-md-6 mx-auto">
    <div class="card-header text-black" style="background: white">
        <h5 class="mb-0">Informasi Mitra</h5>
    </div>
    <div class="card-body">
        <p><strong>Nama Perusahaan:</strong> {{ $mitra->nama_perusahaan }}</p>
        <p><strong>Bidang Usaha:</strong> {{ $mitra->bidang_usaha }}</p>
        <p><strong>No. Telepon:</strong> {{ $mitra->no_telpon }}</p>
        <p><strong>Nama Pimpinan:</strong> {{ $mitra->nama_pimpinan }}</p>
        <p><strong>Alamat:</strong> {{ $mitra->alamat }}</p>
    </div>
</div>
@else
<div class="alert alert-warning col-md-6 mx-auto" role="alert">
    Anda belum terhubung dengan mitra.
</div>
@endif

@endsection
