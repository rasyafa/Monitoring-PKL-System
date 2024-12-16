@extends('layouts.admin')

@section('title', 'Penugasan')

@section('content')
<div class="container">
    <h1 class="mb-4">Penugasan</h1>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

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
</style>
@endpush
