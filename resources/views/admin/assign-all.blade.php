@extends('layouts.admin')

@section('title', 'Penugasan')

@section('content')
<div class="container">
    <h1 class="mb-4">Penugasan</h1>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>{!! session('success') !!}</div>
        </div>
    @endif

    <!-- Error Alerts -->
    @if ($errors->any())
    <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
        <i class="bi bi-x-circle-fill me-2"></i>
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- Assignment Form -->
    <form action="{{ route('assignAll') }}" method="POST">
        @csrf

        <!-- Pilih Siswa -->
        <div class="form-group">
            <label for="student_id">Pilih Siswa</label>
            <select name="student_id" class="form-control" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach ($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Mentor -->
        <div class="form-group">
            <label for="mentor_id">Pilih Mentor</label>
            <select name="mentor_id" class="form-control" required>
                <option value="">-- Pilih Mentor --</option>
                @foreach ($mentors as $mentor)
                <option value="{{ $mentor->id }}">{{ $mentor->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Pembimbing -->
        <div class="form-group">
            <label for="pembimbing_id">Pilih Pembimbing</label>
            <select name="pembimbing_id" class="form-control" required>
                <option value="">-- Pilih Pembimbing --</option>
                @foreach ($pembimbings as $pembimbing)
                <option value="{{ $pembimbing->id }}">{{ $pembimbing->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Mitra -->
        <div class="form-group">
            <label for="mitra_id">Pilih Mitra</label>
            <select name="mitra_id" class="form-control" required>
                <option value="">-- Pilih Mitra --</option>
                @foreach ($mitras as $mitra)
                <option value="{{ $mitra->id }}">{{ $mitra->nama_perusahaan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Assign -->
        <button type="submit" class="btn btn-custom-green">Assign</button>
    </form>
</div>
@endsection

@push('styles')
<style>
    .btn-custom-green {
        background-color: #2bcf51;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-custom-green:hover {
        background-color: #249c42;
    }

    .alert {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 16px;
        font-size: 16px;
    }
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
    }
    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .alert i {
        font-size: 20px;
    }

    .alert ul {
        margin-top: 5px;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endpush
