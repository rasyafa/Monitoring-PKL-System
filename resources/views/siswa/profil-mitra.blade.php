@extends('layouts.siswa')

@section('content')

<h2>Detail Mitra Anda</h2>
@if($mitra)
<p>Nama Perusahaan: {{ $mitra->nama_perusahaan }}</p>
<p>Bidang Usaha: {{ $mitra->bidang_usaha }}</p>
<p>No. Telepon: {{ $mitra->no_telpon }}</p>
<p>Nama Pimpinan: {{ $mitra->nama_pimpinan }}</p>
<p>Alamat: {{ $mitra->alamat }}</p>
@else
<p>Anda belum terhubung dengan mitra.</p>
@endif

@endsection
