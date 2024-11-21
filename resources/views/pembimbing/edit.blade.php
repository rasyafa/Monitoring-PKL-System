@extends('layouts.pembimbing')

@section('title', 'Edit Kegiatan')

@section('header', 'Edit Kegiatan')

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
    </style>

    <div>
        <form action="{{ route('pembimbing.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Input Tanggal -->
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $kegiatan->tanggal }}" required>
            </div>

            <!-- Input Kegiatan -->
            <div class="mb-3">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <textarea class="form-control" id="kegiatan" name="kegiatan" rows="4" required>{{ $kegiatan->kegiatan }}</textarea>
            </div>

            <!-- Input Gambar -->
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                <small>Gambar saat ini:</small><br>
                <img id="currentImage" src="{{ asset('storage/gambar/' . $kegiatan->image) }}" alt="Current Image" width="100">
                <div id="preview-container" style="display: none;">
                    <small>Preview:</small><br>
                    <img id="preview-image" src="#" alt="Preview Image" width="100">
                </div>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const currentImage = document.getElementById('currentImage');
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');

            if (file) {
                previewImage.src = URL.createObjectURL(file);
                previewContainer.style.display = 'block';
                currentImage.style.display = 'none';
            } else {
                previewContainer.style.display = 'none';
                currentImage.style.display = 'block';
            }
        }
    </script>
@endsection
