@extends('layouts.admin')

@section('title', 'Penugasan')

@section('page-title', 'Penugasan')

@section('content')
<div class="container">
    <h2>Penugasan Mitra ke Siswa</h2>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.assignSiswa') }}" method="POST">
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
            <label for="mitra_id">Pilih Mitra</label>
            <select class="form-control" id="mitra_id" name="mitra_id">
                @foreach ($mitras as $mitra)
                <option value="{{ $mitra->id }}">{{ $mitra->nama_perusahaan }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Assign Mitra</button>
    </form>
</div>
@endsection
