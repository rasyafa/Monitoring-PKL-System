<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-4">Edit Absen</h2>

        <!-- Form untuk mengedit absen -->
        <form action="{{ route('admin.absen.update', $absen->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="user_id" class="form-label">Nama Siswa</label>
                <select class="form-control" id="user_id" name="user_id">
                    @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $absen->user_id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $absen->tanggal }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Status Kehadiran</label>
                <select class="form-control" name="status">
                    <option value="Hadir" {{ $absen->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="Sakit" {{ $absen->status == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="Izin" {{ $absen->status == 'Izin' ? 'selected' : '' }}>Izin</option>
                    <option value="Alpha" {{ $absen->status == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.absen.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>
