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

    <form action="{{ route('admin.assignMentor', ['id' => $selectedStudent->id ?? null]) }}" method="POST">
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
        <button type="submit" class="btn btn-primary mt-3">Assign Mentor</button>
    </form>
</div>
@endsection
