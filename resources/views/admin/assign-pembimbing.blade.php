@extends('layouts.admin')

@section('title', 'Penugasan')

@section('page-title', 'Penugasan')

@section('content')
<h1>Penugasan Pembimbing</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.assignPembimbing') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="student">Pilih Siswa:</label>
        <select name="student_id" class="form-control" required>
            @foreach ($students as $student)
            <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="pembimbing">Pilih Pembimbing:</label>
        <select name="pembimbing_id" class="form-control" required>
            @foreach ($pembimbings as $pembimbing)
            <option value="{{ $pembimbing->id }}">{{ $pembimbing->name }}</option>
            @endforeach
        </select>
    </div>


    <button type="submit" class="btn btn-custom-green">Tugaskan Pembimbing</button>

</form>
@endsection

@push('styles')
<style>
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
