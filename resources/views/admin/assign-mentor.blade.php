@extends('layouts.admin')

@section('title', 'Assign')

@section('page-title', 'Assign')

@section('content')
<div class="container">
    <h2>Assign Mentor to Siswa</h2>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.assignMentor') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_id">Pilih Siswa</label>
            <select class="form-control" id="student_id" name="student_id">
                @foreach ($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="mentor_id">Pilih Mentor</label>
            <select class="form-control" id="mentor_id" name="mentor_id">
                @foreach ($mentors as $mentor)
                <option value="{{ $mentor->id }}">{{ $mentor->name }}</option>
                @endforeach
            </select>
            @error('mentor_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn-custom-green mt-3">Assign Mentor</button>
    </form>
</div>
@endsection

@push('styles')
<style>
    .btn-custom-green {
    background-color: #2bcf51; /* Warna hijau */
    border: none;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    }

    /* Efek hover pada tombol */
    .btn-custom-green:hover {
    background-color: #19a938; /* Warna hijau lebih gelap saat hover */
    box-shadow: 0 4px 8px rgba(0, 128, 0, 0.3);
    }

</style>

@endpush
