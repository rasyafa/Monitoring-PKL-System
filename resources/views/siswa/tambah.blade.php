<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Menentukan karakter encoding dan pengaturan viewport untuk responsivitas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Judul halaman yang muncul di tab browser -->
    <title>Tambah Kegiatan</title>

    <!-- Menyertakan file CSS Bootstrap dari CDN untuk styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styling kustom untuk tombol -->
    <style>
        /* Menentukan gaya tombol dengan warna hijau */
        .btn-custom {
            background-color: #03d703;
            border-color: #03d703;
            color: white;
        }

        /* Efek hover untuk tombol ketika diarah dengan kursor */
        .btn-custom:hover {
            background-color: #02c102;
            border-color: #02c102;
        }
    </style>
</head>
<body>

    <!-- Container utama untuk form tambah kegiatan -->
    <div class="container mt-5">
        <!-- Judul halaman -->
        <h1>Tambah Kegiatan Harian</h1>

        <!-- Form untuk memasukkan data kegiatan -->
        <form action="{{ route('siswa.kegiatan.store') }}" method="POST">
            @csrf <!-- Menambahkan token CSRF untuk melindungi form dari serangan -->

            <!-- Input untuk memilih tanggal kegiatan -->
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>

            <!-- Input untuk memasukkan waktu mulai kegiatan -->
            <div class="mb-3">
                <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" required>
            </div>

            <!-- Input untuk memasukkan waktu selesai kegiatan -->
            <div class="mb-3">
                <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" required>
            </div>

            <!-- Textarea untuk deskripsi kegiatan -->
            <div class="mb-3">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <textarea class="form-control" id="kegiatan" name="kegiatan" rows="3" required></textarea>
            </div>

            <!-- Tombol untuk mengirimkan form -->
            <button type="submit" class="btn btn-custom">Simpan Kegiatan</button>

            <!-- Tombol untuk kembali ke halaman riwayat kegiatan -->
            <a href="{{ route('siswa.riwayat-kegiatan') }}" class="btn btn-secondary">Kembali ke Riwayat</a>
        </form>
    </div>

    <!-- Menyertakan file JavaScript Bootstrap untuk fungsionalitas tertentu -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
