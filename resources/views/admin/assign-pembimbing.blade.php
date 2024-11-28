@extends('layouts.admin')

@section('content')
<h1>Penugasan Pembimbing</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.assignPembimbing') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="student">Pilih Siswa:</label>
        <select name="student_id" class="form-control" required>
            @foreach ($students as $student)
            <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="pembimbing">Pilih Pembimbing:</label>
        <select name="pembimbing_id" class="form-control" required>
            @foreach ($pembimbings as $pembimbing)
            <option value="{{ $pembimbing->id }}">{{ $pembimbing->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Tugaskan Pembimbing</button>
</form>
@endsection
