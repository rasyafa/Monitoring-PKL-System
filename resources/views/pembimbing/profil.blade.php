@extends('layouts.pembimbing')

@section('content')
<title>Profil Mentor</title>
<style>
    /* Menyusun layout dengan flexbox agar card berada di tengah */
    body {
        background-color: #f4f4f4;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0; /* Menghilangkan margin default pada body */
        height: 100vh; /* Menjamin body mengambil seluruh tinggi viewport */
    }

    .container {
        display: flex;
        justify-content: center; /* Menyelaraskan card secara horizontal */
        align-items: center; /* Menyelaraskan card secara vertikal */
        height: 100%; /* Menjamin container mengisi seluruh tinggi layar */
        padding: 10px; /* Memberikan jarak sedikit pada container */
    }

    .card {
        width: 100%;
        max-width: 400px; /* Membatasi lebar card agar lebih kecil */
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        height: auto;
        margin: 10px; /* Memberikan jarak pada card dengan konten lain */
    }

    .card-body {
        padding: 20px;  /* Mengurangi padding pada card untuk tampil lebih ringkas */
    }

    .profile-info {
        text-align: center;
        background-color: white;
        border-radius: 15px;
        padding: 15px;  /* Mengurangi padding dalam profile-info */
    }

    .profile-photo {
        border-radius: 50%;
        width: 100px;  /* Mengurangi ukuran foto profil */
        height: 100px; /* Mengurangi ukuran foto profil */
        object-fit: cover;
        border: 5px solid #03d703;
    }

    .profile-placeholder {
        display: inline-block;
        width: 100px;  /* Mengurangi ukuran placeholder */
        height: 100px; /* Mengurangi ukuran placeholder */
        background-color: #e9ecef;
        border-radius: 50%;
        line-height: 100px;
        font-size: 40px;
        color: #03d703;
        font-weight: bold;
    }

    h3 {
        color: #03d703;
        margin-top: 15px; /* Mengurangi margin top agar lebih kompak */
    }

    p {
        color: #666;
        font-size: 1rem; /* Mengurangi ukuran font */
    }

    .btn-custom {
        background-color: #03d703;
        color: white;
        border: none;
        padding: 10px 25px; /* Mengurangi padding tombol agar tidak terlalu besar */
        border-radius: 25px;
        font-size: 1rem; /* Mengurangi ukuran font tombol */
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-custom:hover {
        background-color: #02be02;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .card-body .mb-2 {
        font-size: 1rem;
        color: #555;
        margin-bottom: 12px; /* Mengurangi margin bottom agar lebih rapat */
    }

    .card-body .mb-2 span {
        color: #333;
    }

    /* Styling untuk edit button */
    .btn-custom:hover {
        background-color: #02be02; /* Hover warna #02be02 */
    }
</style>


<div class="container">
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="d-flex">
                <!-- Bagian Kiri: Informasi Pribadi Mentor -->
                <div class="col-md-12 profile-info">
                    <div class="text-center">
                        @if($pembimbing->profile_photo)
                            <img src="{{ Storage::url($pembimbing->profile_photo) }}" alt="Foto Profil" class="profile-photo">
                        @else
                            <div class="profile-placeholder">{{ strtoupper(substr($pembimbing->username, 0, 1)) }}</div>
                        @endif
                    </div>

                    <h3>{{ $pembimbing->name }}</h3>
                    <p><b>Informasi pribadi</b></p>
                    <div class="mb-2">
                        <strong>Nama pengguna:</strong> <span>{{ $pembimbing->username }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Email:</strong> <span>{{ $pembimbing->email }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Kota:</strong> <span>{{ $pembimbing->city }}</span>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('pembimbing.editprofil', $pembimbing->id) }}" class="btn btn-custom btn-lg">Edit Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection