@extends('layouts.app')

@section('title', 'Data Siswa')

@section('header', 'Data Siswa')

@section('content')
    <style>
        body {
            background-color: #f1f1f1;
            font-family: sans-serif;
        }

        .container {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

         .btn-custom {
            background-color: #03d703;
            border-color: #03d703;
            color: white;
        }

        .btn-custom:hover {
            background-color: #028d02;
            border-color: #028d02;
        }

        .btn-secondary-custom {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        .btn-secondary-custom:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        body,
        label,
        h2 {
            color: black;
        }

        /* Styling untuk textarea */
        textarea {
            resize: vertical;
            min-height: 100px;
        }
    </style>



        <!-- Form untuk mengedit kegiatan -->
        <form action="{{ route('pembimbing.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Menandakan bahwa ini adalah request PUT -->

    <!-- Input Tanggal -->
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ $kegiatan->tanggal }}" required>
        @error('tanggal')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Input Kegiatan (Textarea) -->
    <div class="form-group">
        <label for="kegiatan">Kegiatan</label>
        <textarea name="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror" rows="4" required>{{ $kegiatan->kegiatan }}</textarea>
        @error('kegiatan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Input Image -->
    <div class="mb-3">
       <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if($kegiatan->image)
           <small>Gambar saat ini:</small><br>
                <img src="{{ asset('storage/gambar/' . $kegiatan->image) }}" width="100">
        @endif

    </div>

    <!-- Tombol Edit dan Kembali -->
    <div class="btn-container">
        <button type="submit" class="btn btn-primary">Perbarui Kegiatan</button>
        <a href="{{ route('pembimbing.monitoring') }}" class="btn btn-secondary-custom">Kembali</a>
    </div>
    {{-- <div class="btn-container">
                <button type="submit" class="btn btn-primary">Tambah Kegiatan</button>
                <a href="{{ route('pembimbing.home') }}" class="btn btn-secondary-custom">Kembali</a>
            </div> --}}
</form>
    </div>

    @endsection
