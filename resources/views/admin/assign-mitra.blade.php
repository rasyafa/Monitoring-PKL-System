@extends('layouts.admin')

@section('title', 'Penugasan')

@section('page-title', 'Penugasan')

@section('content')
<h1>Penugasan Mitra</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.assignMitra') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="mitra">Pilih Mitra:</label>
        <select name="mitra_id" class="form-control" required>
            @foreach ($mitras as $mitra)
            <option value="{{ $mitra->id }}">{{ $mitra->nama_perusahaan }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="mentor">Pilih Mentor:</label>
        <select name="mentor_ids[]" class="form-control" multiple required>
            @foreach ($mentors as $mentor)
            <option value="{{ $mentor->id }}">{{ $mentor->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="pembimbing">Pilih Pembimbing:</label>
        <select name="pembimbing_ids[]" class="form-control" multiple required>
            @foreach ($pembimbings as $pembimbing)
            <option value="{{ $pembimbing->id }}">{{ $pembimbing->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-custom-green">Assign Mitra</button>
</form>
@endsection

@push('styles')
<style>

    /* Tampilan card form dengan ukuran yang lebih besar */
    .card {
    width: 100%; /* Memperbesar card menjadi 80% dari lebar layar */
    background-color: #ffffff; /* Latar belakang card abu-abu terang */
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Bayangan lembut pada card */
    }
    /* Styling untuk tombol hijau */
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

    /* Styling untuk tombol hijau */
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
    margin-top: 20px; /* Memberikan jarak atas tombol */
    margin-bottom: 20px; /* Memberikan jarak bawah tombol */
    width: 100%; /* Membuat tombol memenuhi lebar kontainer */
    }

    /* Efek hover pada tombol */
    .btn-custom-green:hover {
    background-color: #19a938; /* Warna hijau lebih gelap saat hover */
    box-shadow: 0 4px 8px rgba(0, 128, 0, 0.3);
    }
</style>

@endpush
