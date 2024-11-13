<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom {
            background-color: #03d703;
            border-color: #03d703;
            color: white;
        }

        .btn-custom:hover {
            background-color: #02c102;
            border-color: #02c102;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Kegiatan Harian</h1>
        <form action="{{ route('siswa.kegiatan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="mb-3">
                <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" required>
            </div>
            <div class="mb-3">
                <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" required>
            </div>
            <div class="mb-3">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <textarea class="form-control" id="kegiatan" name="kegiatan" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-custom">Simpan Kegiatan</button>
            <a href="{{ route('siswa.riwayat-kegiatan') }}" class="btn btn-secondary">Kembali ke Riwayat</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>