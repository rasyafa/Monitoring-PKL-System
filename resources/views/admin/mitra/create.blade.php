@extends('layouts.admin')

@section('content')
<h1>Tambah Mitra Baru</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.mitra.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nama_perusahaan">Nama Perusahaan:</label>
        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="bidang_usaha">Bidang Usaha:</label>
        <input type="text" name="bidang_usaha" id="bidang_usaha" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="no_telpon">No Telepon:</label>
        <input type="text" name="no_telpon" id="no_telpon" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="nama_pimpinan">Nama Pimpinan:</label>
        <input type="text" name="nama_pimpinan" id="nama_pimpinan" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="alamat">Alamat:</label>
        <textarea name="alamat" id="alamat" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label for="mentor_ids">Pilih Mentor:</label>
        <select name="mentor_ids[]" class="form-control" multiple required>
            @foreach ($mentors as $mentor)
            <option value="{{ $mentor->id }}">{{ $mentor->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="pembimbing_ids">Pilih Pembimbing:</label>
        <select name="pembimbing_ids[]" class="form-control" multiple required>
            @foreach ($pembimbings as $pembimbing)
            <option value="{{ $pembimbing->id }}">{{ $pembimbing->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Mitra</button>
</form>
@endsection
