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
            </div>
</form>
    </div>
    @endsection
