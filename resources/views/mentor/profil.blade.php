@extends('layouts.mentor')

@section('content')
<title>Profil Mentor</title>
<style>
    /* Menyusun layout dengan flexbox agar card berada di tengah */
    body {
        background-color: #f4f4f4;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Membuat container setinggi layar */
    }

    .card {
        width: 100%;
        max-width: 600px; /* Membatasi lebar card agar tidak terlalu lebar */
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 30px;
    }

    .profile-info {
        text-align: center;
        background-color: white;
        border-radius: 15px;
        padding: 20px;
    }

    .profile-photo {
        border-radius: 50%;
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 5px solid #03d703;
    }

    .profile-placeholder {
        display: inline-block;
        width: 120px;
        height: 120px;
        background-color: #e9ecef;
        border-radius: 50%;
        line-height: 120px;
        font-size: 50px;
        color: #03d703;
        font-weight: bold;
        background: #e9ecef;
    }

    h3 {
        color: #03d703;
        margin-top: 20px;
    }

    p {
        color: #666;
        font-size: 1.2rem;
    }

    .btn-custom {
        background-color: #03d703;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-custom:hover {
        background-color: #02be02;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .card-body .mb-2 {
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 15px;
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
                        @if($mentor->profile_photo)
                            <img src="{{ Storage::url($mentor->profile_photo) }}" alt="Foto Profil" class="profile-photo">
                        @else
                            <div class="profile-placeholder">{{ strtoupper(substr($mentor->username, 0, 1)) }}</div>
                        @endif
                    </div>

                    <h3>{{ $mentor->name }}</h3>
                    <p><b>Informasi pribadi</b></p>
                    <div class="mb-2">
                        <strong>Nama pengguna:</strong> <span>{{ $mentor->username }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Email:</strong> <span>{{ $mentor->email }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Kota:</strong> <span>{{ $mentor->city }}</span>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('mentor.edit', $mentor->id) }}" class="btn btn-custom btn-lg">Edit Profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
