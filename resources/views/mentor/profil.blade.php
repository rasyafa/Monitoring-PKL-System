@extends('layouts.mentor')

@section('content')
<title>Profil Mentor</title>
<div class="container">
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <div class="col-md-6 profile-info text-center">
                    <div>
                        @if($mentor->profile_photo)
                        <img src="{{ Storage::url($mentor->profile_photo) }}" alt="Foto Profil" class="profile-photo">
                        @else
                        <div class="profile-placeholder">
                            {{ strtoupper(substr($mentor->name ?? 'U', 0, 1)) }}
                        </div>
                        @endif
                    </div>
                    <h3>{{ $mentor->name }}</h3>
                    <p><b>Informasi Pribadi</b></p>
                    <div class="mb-2">
                        <strong>Nama Pengguna:</strong> <span>{{ $mentor->username }}</span>
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

@push('styles')
<style>
    body {
        background-color: #f4f4f4;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        /* Pastikan container memenuhi seluruh layar */
    }

    .card {
        max-width: 600px;
        width: 100%;
        /* Membuat card lebih fleksibel */
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-info {
        padding: 20px;
        /* Memberikan padding pada profil info */
    }

    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
        /* Memberikan jarak antara gambar dan nama */
    }

    .profile-placeholder {
        display: inline-block;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: #e9ecef;
        line-height: 120px;
        text-align: center;
        font-size: 50px;
        color: #03d703;
        font-weight: bold;
    }

    .btn-custom {
        background-color: #03d703;
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        font-size: 1rem;
        text-decoration: none;
    }

    .btn-custom:hover {
        background-color: #02be02;
    }
</style>
@endpush
