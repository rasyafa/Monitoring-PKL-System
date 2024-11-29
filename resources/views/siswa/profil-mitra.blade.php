<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tag untuk karakter set dan pengaturan viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Mitra Anda</title>

    <!-- Menyertakan Bootstrap CSS untuk styling standar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Menyertakan Bootstrap Icons untuk ikon di dalam aplikasi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Styling untuk header card dengan background putih */
        .header-white {
            background-color: white !important;
            color: black !important;
        }

        /* Styling untuk teks yang lebih tebal dan berwarna hitam */
        .text-strong {
            color: black;
            font-weight: bold;
        }

        /* Custom styling untuk tombol dengan warna abu-abu */
        .btn-gray {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        /* Hover effect untuk tombol abu-abu */
        .btn-gray:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        /* Custom card yang lebih besar dan responsif */
        .card-custom {
            width: 90%; /* Membuat card lebih fleksibel */
            max-width: 900px; /* Membatasi ukuran maksimal card */
        }

        /* Membuat container dengan posisi pusat di layar */
        .container-center {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <!-- Container utama dengan gaya center untuk menempatkan card di tengah halaman -->
    <div class="container container-center">
        <!-- Card dengan border dan shadow untuk tampilan lebih menarik -->
        <div class="card card-custom shadow border-0">
            <!-- Header card yang berisi judul dan ikon -->
            <div class="card-header header-white d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Detail Mitra Anda</h3>
                <i class="bi bi-briefcase-fill"></i>
            </div>

            <!-- Body card yang berisi detail mitra -->
            <div class="card-body p-4">
                <!-- Cek apakah data mitra tersedia -->
                @if($mitra)
                <ul class="list-group list-group-flush">
                    <!-- Menampilkan informasi mitra seperti nama perusahaan, bidang usaha, dsb -->
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong class="text-strong">Nama Perusahaan:</strong>
                        <span class="text-muted">{{ $mitra->nama_perusahaan }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong class="text-strong">Bidang Usaha:</strong>
                        <span class="text-muted">{{ $mitra->bidang_usaha }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong class="text-strong">No. Telepon:</strong>
                        <span class="text-muted">{{ $mitra->no_telpon }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong class="text-strong">Nama Pimpinan:</strong>
                        <span class="text-muted">{{ $mitra->nama_pimpinan }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong class="text-strong">Alamat:</strong>
                        <span class="text-muted">{{ $mitra->alamat }}</span>
                    </li>
                </ul>
                @else
                <!-- Jika tidak ada data mitra, tampilkan pesan peringatan -->
                <div class="alert alert-danger text-center">
                    <i class="bi bi-exclamation-circle-fill"></i> Anda belum terhubung dengan mitra.
                </div>
                @endif
            </div>

            <!-- Footer card dengan tombol kembali -->
            <div class="card-footer text-end bg-light">
                <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-gray">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Menyertakan Bootstrap JS untuk interaktivitas (seperti tombol dan popups) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
