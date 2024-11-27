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
        background-color: #f8f9fa; /* Warna latar belakang */
        display: flex;
        justify-content: center; /* Menyelaraskan form di tengah horizontal */
        align-items: flex-start; /* Menyelaraskan form di atas */
        height: 100vh; /* Tinggi penuh layar */
        margin: 0;
        }

        .form-container {
        background-color: white; /* Warna dasar form */
        padding: 40px; /* Jarak isi dengan tepi */
        border-radius: 10px; /* Membulatkan sudut */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Efek bayangan */
        width: 100%; /* Lebar penuh */
        max-width: 1000px; /* Lebar maksimum */
        max-height: 90vh; /* Tinggi maksimum */
        overflow-y: auto; /* Gulir jika konten terlalu panjang */
        }

        .form-header {
        font-size: 24px; /* Ukuran teks judul */
        font-weight: bold; /* Teks tebal */
        margin-bottom: 30px; /* Jarak bawah */
        text-align: center; /* Rata tengah */
        }

        .form-group {
        margin-bottom: 20px; /* Jarak antar input */
        }

        label {
        font-weight: bold; /* Teks label tebal */
        }

        input.form-control {
        border-radius: 5px; /* Membulatkan input */
        padding: 10px; /* Jarak dalam */
        }

        .form-control-file {
        border-radius: 5px; /* Membulatkan input file */
        padding: 10px; /* Jarak dalam */
        }

        .text-center {
        text-align: center; /* Rata tengah gambar */
        }

        .btn-sm {
        padding: 8px 16px; /* Ukuran tombol kecil */
        font-size: 14px; /* Ukuran font kecil */
        border-radius: 5px; /* Membulatkan tombol */
        }

        .error-message {
        color: red; /* Warna pesan error */
        font-size: 14px; /* Ukuran teks pesan error */
        }

        .profile-photo-preview {
        max-width: 150px; /* Lebar maksimal gambar profil */
        margin-top: 10px; /* Jarak atas gambar */
        max-height: 150px; /* Tinggi maksimal gambar profil */
        object-fit: cover; /* Menjaga proporsi gambar */
        }

        .btn-green {
        background-color: #03d703; /* Warna tombol hijau */
        border-color: #03d703; /* Warna border */
        color: white; /* Warna teks */
        }

        .btn-green:hover {
        background-color: #02c602; /* Warna hover */
        border-color: #02c602; /* Border hover */
        }

        .button-container {
        display: flex; /* Menyusun tombol dalam baris */
        justify-content: flex-start; /* Tombol rata kiri */
        gap: 10px; /* Jarak antar tombol */
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
        .form-container {
        padding: 20px; /* Jarak isi lebih kecil */
        }

        .btn-sm {
        font-size: 16px; /* Ukuran font lebih besar */
        }

        .form-header {
        font-size: 20px; /* Ukuran judul lebih kecil */
        }

        .profile-photo-preview {
        max-width: 120px; /* Ukuran gambar lebih kecil */
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

            <!-- Input Password -->
            <div class="form-group">
                <label for="password">Kata Sandi Baru</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru">
                @error('password')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Konfirmasi Password -->
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="Konfirmasi password baru">
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
