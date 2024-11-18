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

        .btn-primary {
            background-color: #03d703;
            border-color: #03d703;
        }

        .btn-primary:hover {
            background-color: #02be02;
            border-color: #02be02;
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

        <!-- Form untuk menambahkan kegiatan -->
       <form action="{{ route('pembimbing.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Input Tanggal -->
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <!-- Input Kegiatan (Textarea) -->
    <div class="form-group">
        <label for="kegiatan">Kegiatan</label>
        <textarea name="kegiatan" class="form-control" rows="4" required></textarea>
    </div>

    <!-- Input Image -->
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
        @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Tombol Tambah dan kembali -->
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Tambah Kegiatan</button>
                <a href="{{ route('pembimbing.home') }}" class="btn btn-secondary-custom">Kembali</a>
            </div>
</form>
    </div>
    @endsection

    
