@extends('layouts.admin')

@section('content')
<h1>Assign Mitra</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.assignMitra') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="mitra">Pilih Mitra:</label>
        <select name="mitra_id" class="form-control" required>
            @foreach ($mitras as $mitra)
            <option value="{{ $mitra->id }}">{{ $mitra->nama_perusahaan }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="mentor">Pilih Mentor:</label>
        <select name="mentor_ids[]" class="form-control" multiple required>
            @foreach ($mentors as $mentor)
            <option value="{{ $mentor->id }}">{{ $mentor->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="pembimbing">Pilih Pembimbing:</label>
        <select name="pembimbing_ids[]" class="form-control" multiple required>
            @foreach ($pembimbings as $pembimbing)
            <option value="{{ $pembimbing->id }}">{{ $pembimbing->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Assign Mitra</button>
</form>
@endsection
