<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Meta data untuk karakter set dan viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan</title>

    <!-- Link ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom style untuk tombol */
        .btn-custom {
            background-color: #03d703;
            border-color: #03d703;
            color: white;
        }

        /* Hover effect untuk tombol */
        .btn-custom:hover {
            background-color: #02c102;
            border-color: #02c102;
        }

        /* Styling untuk container toast (notifikasi error) */
        .toast-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1055;
        }
    </style>
</head>
<body>

    <!-- Container utama halaman -->
    <div class="container mt-5">
        <h1>Tambah Kegiatan Harian</h1>

        <!-- Alert Error: Jika ada error, tampilkan toast sebagai notifikasi -->
        @if ($errors->has('error'))
        <div class="toast-container">
            <div class="toast align-items-center text-bg-danger border-0" id="errorToast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ $errors->first('error') }} <!-- Menampilkan pesan error pertama -->
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif

        <!-- Form untuk menambah kegiatan -->
        <form action="{{ route('siswa.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- Token CSRF untuk keamanan -->

            <!-- Input untuk Tanggal Kegiatan -->
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>

            <!-- Input untuk Waktu Mulai Kegiatan -->
            <div class="mb-3">
                <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" required>
            </div>

            <!-- Input untuk Waktu Selesai Kegiatan -->
            <div class="mb-3">
                <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" required>
            </div>

            <!-- Textarea untuk deskripsi Kegiatan -->
            <div class="mb-3">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <textarea class="form-control" id="kegiatan" name="kegiatan" rows="3" required></textarea>
            </div>

            <!-- Input untuk Upload Foto Bukti Kegiatan -->
            <div class="mb-3">
                <label for="foto" class="form-label">Bukti Kegiatan</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            </div>

            <!-- Tombol untuk submit form -->
            <button type="submit" class="btn btn-custom">Simpan Kegiatan</button>

            <!-- Tombol untuk kembali ke riwayat kegiatan -->
            <a href="{{ route('siswa.riwayat-kegiatan') }}" class="btn btn-secondary">Kembali ke Riwayat</a>
        </form>
    </div>

    <!-- Script Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Tampilkan toast jika ada error
        @if ($errors->has('error'))
        const errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
        errorToast.show();
        @endif
    </script>
</body>
</html>
