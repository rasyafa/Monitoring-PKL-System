<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <!-- Menambahkan Bootstrap CSS untuk desain -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .form-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input.form-control {
            border-radius: 5px;
            padding: 10px;
        }

        .form-control-file {
            border-radius: 5px;
            padding: 10px;
        }

        .text-center {
            text-align: center;
        }

        /* Mengatur ukuran tombol agar lebih kecil */
        .btn-sm {
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 5px;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }

        .profile-photo-preview {
            max-width: 150px;
            margin-top: 10px;
            max-height: 150px;
            object-fit: cover;
        }

        /* Mengubah warna tombol Simpan Perubahan menjadi hijau (#03d703) dan teks putih */
        .btn-green {
            background-color: #03d703;
            border-color: #03d703;
            color: white;
        }

        .btn-green:hover {
            background-color: #02c602;
            border-color: #02c602;
        }

        /* Menata tombol agar berada di sisi kiri */
        .button-container {
            display: flex;
            justify-content: flex-start; /* Tombol berada di kiri */
            gap: 10px; /* Jarak antar tombol */
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        /* Responsif untuk perangkat lebih kecil */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            .btn-sm {
                font-size: 16px;
            }

            .form-header {
                font-size: 20px;
            }

            .profile-photo-preview {
                max-width: 120px;
            }
        }
    </style>
</head>

<body>

    <div class="form-container">
        <!-- Teks Judul Edit Profil -->
        <div class="form-header">
            Edit Profil
        </div>

        <!-- Form Edit Profil -->
        <form method="POST" action="{{ route('siswa.update', $siswa->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <!-- Input Nama (full_name) -->
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $siswa->name) }}"
                    required>
                @error('full_name')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Username (username) - non-editable -->
            <div class="form-group">
                <label for="username">Nama pengguna</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $siswa->username }}"
                    disabled>
            </div>

            <!-- Input Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $siswa->email) }}" required>
                @error('email')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Kota -->
            <div class="form-group">
                <label for="city">Kota</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $siswa->city) }}"
                    required>
                @error('city')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Foto Profil -->
            <div class="form-group">
                <label for="profile_photo">Foto Profil</label>
                <input type="file" class="form-control-file" id="profile_photo" name="profile_photo">
                @if($siswa->profile_photo)
                <div class="text-center">
                    <img src="{{ Storage::url($siswa->profile_photo) }}" alt="Foto Profil"
                        class="profile-photo-preview">
                </div>
                @endif
                @error('profile_photo')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button Save and Cancel -->
            <div class="button-container">
                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-green btn-sm">Simpan Perubahan</button>

                <!-- Tombol Batal -->
                <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-secondary btn-sm">Batal</a>
            </div>
        </form>
    </div>

    <!-- Menambahkan Bootstrap JS untuk interaksi jika diperlukan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
