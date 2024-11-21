@extends('layouts.pembimbing')

@section('content')
    <style>
        /* Style untuk mengatur tampilan container dan card */
        :root {
            --main-bg-color: #03d703;
            --main-text-color: #03d703;
            --second-text-color: #686868;
            --second-bg-color: #fff;
            --toggle-color: #03d703;
            --heading-color: #03d703;
        }


        label {
            color: #333; /* Warna teks yang jelas */
            font-size: 1rem;

        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 15px; /* Memberikan padding agar form tidak terlalu mepet */
        }

        .form-header {
            text-align: center;
            font-size: 1.5rem;
            color: #03d703;
            margin-bottom: 20px;
        }

         /* Foto profil di bawah form */
        .profile-photo-preview {
            border-radius: 50%;
            width: 120px; /* Menyesuaikan ukuran foto profil agar lebih besar */
            height: 120px;
            object-fit: cover;
            border: 5px solid #03d703;

        }

        .error-message {
            color: red;
            font-size: 0.9rem;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 15px; /* Mengurangi jarak antara tombol */
        }

        .card {
            width: 100%;
            max-width: 500px; /* Membatasi lebar card agar lebih kecil */
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            margin: 0 15px;
            padding-bottom: 50px; /* Memberikan padding bawah lebih banyak */
            min-height: 800px; /* Menambahkan min-height agar card cukup panjang */
        }

        .card-body {
            padding: 40px; /* Mengurangi padding agar card lebih compact */
        }

        .form-control {
            border-radius: 8px;
            padding: 10px; /* Mengurangi padding agar input lebih kecil */
            font-size: 0.9rem; /* Mengurangi ukuran font agar input lebih rapat */
        }

        .form-control-file {
            border-radius: 8px;
            padding: 10px;
            font-size: 0.9rem;
        }

        .btn-green {
            background-color: #03d703;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .btn-green:hover {
            background-color: #02be02;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.9rem;
            margin-left: 10px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }



    </style>

    <div class="form-container">
        <div class="card">
            <div class="card-body">
                <div class="form-header">
                    Edit Profil Mentor
                </div>

                <!-- Form Edit Profil Mentor -->
                <form action="{{ route('pembimbing.update1', $pembimbing->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama (full_name) -->
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $pembimbing->name) }}" required>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Username (username) - non-editable -->
                    <div class="form-group">
                        <label for="username">Nama Pengguna</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $pembimbing->username }}" disabled>
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
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password baru">
                    </div>

                    <!-- Input Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $pembimbing->email) }}" required>
                    </div>

                    <!-- Input Kota -->
                    <div class="form-group">
                        <label for="city">Kota</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $pembimbing->city) }}" required>
                        @error('city')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Foto Profil (di bawah form) -->
                    <div class="form-group">
                        <label for="profile_photo">Foto Profil</label>
                        <input type="file" class="form-control-file" id="profile_photo" name="profile_photo">
                       <div class="text-center">
                    <!-- Foto Profil Preview (akan muncul setelah memilih file) -->
                    @if($pembimbing->profile_photo)
                        <img src="{{ Storage::url($pembimbing->profile_photo) }}" alt="Foto Profil" class="profile-photo-preview">
                    @endif
                    </div>
                        @error('profile_photo')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Button Save and Cancel -->
                    <div class="button-container">
                        <button type="submit" class="btn btn-green btn-sm">Simpan Perubahan</button>
                        <a href="{{ route('pembimbing.profil', $pembimbing->id) }}" class="btn btn-secondary btn-sm">Batal</a>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>

@endsection
