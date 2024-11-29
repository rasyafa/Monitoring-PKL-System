<!DOCTYPE html>
<html lang="id"> <!-- Menetapkan bahasa halaman menjadi Bahasa Indonesia -->

<head>
    <meta charset="UTF-8"> <!-- Mengatur karakter encoding untuk memastikan karakter ditampilkan dengan benar -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur agar halaman responsif di perangkat mobile -->
    <title>Edit Profil</title> <!-- Judul halaman yang ditampilkan di tab browser -->

    <!-- Menambahkan Bootstrap CSS untuk desain responsif dan komponen UI yang sudah tersedia -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Gaya khusus untuk penataan tampilan halaman -->
    <style>
        /* Mengatur latar belakang dan penataan body */
        body {


        background-color: #f8f9fa; /* Warna latar belakang */
        display: flex;
        justify-content: center; /* Menyelaraskan form di tengah horizontal */
        align-items: flex-start; /* Menyelaraskan form di atas */
        height: 100vh; /* Tinggi penuh layar */
        margin: 0;

        }

        /* Gaya untuk form container */
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

        /* Gaya untuk judul form */
        .form-header {


        font-size: 24px; /* Ukuran teks judul */
        font-weight: bold; /* Teks tebal */
        margin-bottom: 30px; /* Jarak bawah */
        text-align: center; /* Rata tengah */

        }

        /* Gaya untuk grup input form */
        .form-group {
            margin-bottom: 20px; /* Memberikan jarak antara input */
        }

        label {
            font-weight: bold; /* Membuat teks label lebih tebal */
        }

        input.form-control {
            border-radius: 5px; /* Membuat sudut input melengkung */
            padding: 10px; /* Menambah padding di dalam input */
        }

        .form-control-file {
            border-radius: 5px; /* Membuat sudut file input melengkung */
            padding: 10px; /* Menambah padding */
        }

        .text-center {
            text-align: center; /* Menyusun teks di tengah */
        }

        .btn-sm {
<
        padding: 8px 16px; /* Ukuran tombol kecil */
        font-size: 14px; /* Ukuran font kecil */
        border-radius: 5px; /* Membulatkan tombol */

        }

        /* Gaya untuk menampilkan pesan error */
        .error-message {
            color: red; /* Memberikan warna merah untuk pesan error */
            font-size: 14px; /* Ukuran font pesan error */
        }

        /* Menata gambar preview foto profil */
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

        /* Efek hover pada tombol Simpan Perubahan */
        .btn-green:hover {
            background-color: #02c602; /* Warna sedikit lebih gelap saat hover */
            border-color: #02c602;
        }

        /* Menata agar tombol berada di sisi kiri */
        .button-container {
            display: flex;
            justify-content: flex-start; /* Tombol berada di kiri */
            gap: 10px; /* Menambahkan jarak antara tombol */
        }

        .btn-secondary {
            background-color: #6c757d; /* Warna abu-abu untuk tombol Batal */
            border-color: #6c757d;
            color: white;
        }

        /* Responsif untuk perangkat dengan lebar maksimal 768px (mobile) */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px; /* Mengurangi padding pada perangkat mobile */
            }

            .btn-sm {
                font-size: 16px; /* Membesarkan ukuran font tombol pada mobile */
            }

            .form-header {
                font-size: 20px; /* Mengurangi ukuran font judul pada perangkat mobile */
            }

            .profile-photo-preview {
                max-width: 120px; /* Mengurangi ukuran foto profil pada perangkat mobile */
            }
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
      
        </style>
</head>

<body>

    <div class="form-container">
        <!-- Teks Judul Edit Profil -->
        <div class="form-header">
            Edit Profil
        </div>

        <!-- Form untuk mengedit profil siswa -->
        <form method="POST" action="{{ route('siswa.update', $siswa->id) }}" enctype="multipart/form-data">
            @csrf <!-- Token untuk proteksi CSRF -->
            @method('PUT') <!-- Menyatakan bahwa form ini menggunakan metode PUT untuk update data -->

            <!-- Input untuk Nama Lengkap -->
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $siswa->name) }}" required>
                @error('name') <!-- Menampilkan pesan error jika ada -->
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input untuk Username (hanya tampilkan, tidak bisa diubah) -->
            <div class="form-group">
                <label for="username">Nama Pengguna</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $siswa->username }}" disabled>
            </div>

            <!-- Input untuk Kata Sandi Baru -->
            <div class="form-group">
                <label for="password">Kata Sandi Baru</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru">
                @error('password') <!-- Menampilkan pesan error jika ada -->
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input untuk Konfirmasi Kata Sandi -->
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password baru">
            </div>

            <!-- Input untuk Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $siswa->email) }}" required>
                @error('email') <!-- Menampilkan pesan error jika ada -->
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input untuk Kota -->
            <div class="form-group">
                <label for="city">Kota</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $siswa->city) }}" required>
                @error('city') <!-- Menampilkan pesan error jika ada -->
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input untuk Foto Profil -->
            <div class="form-group">
                <label for="profile_photo">Foto Profil</label>
                <input type="file" class="form-control-file" id="profile_photo" name="profile_photo">
                <!-- Menampilkan gambar foto profil yang sudah ada -->
                @if($siswa->profile_photo)
                <div class="text-center">
                    <img src="{{ Storage::url($siswa->profile_photo) }}" alt="Foto Profil" class="profile-photo-preview">
                </div>
                @endif
                @error('profile_photo') <!-- Menampilkan pesan error jika ada -->
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Container untuk tombol Simpan dan Batal -->
            <div class="button-container">
                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-green btn-sm">Simpan Perubahan</button>

                <!-- Tombol Batal -->
                <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-secondary btn-sm">Batal</a>
            </div>
        </form>
    </div>

    <!-- Menambahkan Bootstrap JS untuk interaksi dan fitur lainnya -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
