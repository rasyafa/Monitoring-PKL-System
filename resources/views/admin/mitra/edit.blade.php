@extends('layouts.admin')

@section('content')
<h1>Edit Data Mitra</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.mitra.update', $mitra->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nama_perusahaan">Nama Perusahaan:</label>
        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control"
            value="{{ old('nama_perusahaan', $mitra->nama_perusahaan) }}" required>
    </div>

    <div class="form-group">
        <label for="bidang_usaha">Bidang Usaha:</label>
        <input type="text" name="bidang_usaha" id="bidang_usaha" class="form-control"
            value="{{ old('bidang_usaha', $mitra->bidang_usaha) }}" required>
    </div>

    <div class="form-group">
        <label for="no_telpon">No Telepon:</label>
        <input type="text" name="no_telpon" id="no_telpon" class="form-control"
            value="{{ old('no_telpon', $mitra->no_telpon) }}" required>
    </div>

    <div class="form-group">
        <label for="nama_pimpinan">Nama Pimpinan:</label>
        <input type="text" name="nama_pimpinan" id="nama_pimpinan" class="form-control"
            value="{{ old('nama_pimpinan', $mitra->nama_pimpinan) }}" required>
    </div>

    <div class="form-group">
        <label for="alamat">Alamat:</label>
        <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat', $mitra->alamat) }}</textarea>
    </div>

    <div class="form-group">
        <label for="mentor_ids">Pilih Mentor:</label>
        <select name="mentor_ids[]" class="form-control" multiple required>
            @foreach ($mentors as $mentor)
            <option value="{{ $mentor->id }}" {{ in_array($mentor->id, $mitra->mentors->pluck('id')->toArray()) ?
                'selected' : '' }}>
                {{ $mentor->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="pembimbing_ids">Pilih Pembimbing:</label>
        <select name="pembimbing_ids[]" class="form-control" multiple required>
            @foreach ($pembimbings as $pembimbing)
            <option value="{{ $pembimbing->id }}" {{ in_array($pembimbing->id,
                $mitra->pembimbings->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $pembimbing->name }}
            </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('admin.mitra.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
