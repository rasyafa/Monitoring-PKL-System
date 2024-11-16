<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container mt-5">
        <h1>Tambah Kegiatan</h1>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

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

            <!-- Tombol Kirim -->
            <br>
            <button type="submit" class="btn btn-primary">Tambah Kegiatan</button>
        </form>
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
 