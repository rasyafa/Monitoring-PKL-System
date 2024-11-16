<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Kegiatan Harian</h1>

        <!-- Formulir Edit Kegiatan -->
        <form action="{{ route('admin.kegiatan.update', $kegiatans->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="user_id" class="form-label">Nama Siswa</label>
                <select class="form-select" name="user_id" id="user_id" required>
                    <option value="">Pilih Siswa</option>
                    @foreach($students as $user)
                    <option value="{{ $user->id }}" {{ $kegiatans->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $kegiatans->tanggal }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai"
                    value="{{ $kegiatans->waktu_mulai }}" required>
            </div>
            <div class="mb-3">
                <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai"
                    value="{{ $kegiatans->waktu_selesai }}" required>
            </div>
            <div class="mb-3">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <textarea class="form-control" id="kegiatan" name="kegiatan" rows="4"
                    required>{{ $kegiatans->kegiatan }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>
