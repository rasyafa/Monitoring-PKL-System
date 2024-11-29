<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gaya untuk body halaman */
        body {
            background-color: #ffffff; /* Mengatur warna latar belakang halaman menjadi putih */
            color: #333; /* Mengatur warna teks menjadi abu-abu gelap */
        }

        /* Gaya untuk judul h2 */
        h2 {
            font-weight: bold; /* Membuat teks judul menjadi tebal */
            color: #505050; /* Mengatur warna teks menjadi abu-abu sedang */
        }

        /* Gaya untuk header tabel */
        .table-head {
            background-color: #0ccf4d; /* Mengatur latar belakang header tabel menjadi hijau */
            color: #fbfdff; /* Mengatur warna teks header menjadi putih */
        }

        /* Gaya untuk body tabel */
        .table-tbody {
            background-color: #ffffff; /* Mengatur latar belakang body tabel menjadi putih */
        }

        /* Gaya untuk tombol dengan kelas .btn-info dan .btn-warning */
        .btn-info,
        .btn-warning {
            background-color: #ffc107; /* Mengatur warna latar belakang tombol menjadi kuning */
            color: 212529; /* Mengatur warna teks tombol menjadi gelap */
            border: none; /* Menghilangkan border pada tombol */
        }

        /* Gaya hover untuk tombol .btn-info dan .btn-warning */
        .btn-info:hover,
        .btn-warning:hover {
            background-color: #ffc107; /* Warna latar belakang tetap sama saat tombol dihover */
        }

        /* Gaya untuk tombol dengan kelas .btn-success */
        .btn-success {
            background-color: #17d033; /* Mengatur warna latar belakang tombol sukses menjadi hijau */
            color: 212529; /* Mengatur warna teks tombol menjadi gelap */
            border: none; /* Menghilangkan border pada tombol */
        }

        /* Gaya hover untuk tombol .btn-success */
        .btn-success:hover {
            background-color: #1b5e20; /* Mengubah warna latar belakang saat tombol dihover menjadi hijau lebih gelap */
        }

        /* Gaya untuk tombol dengan kelas .btn-danger */
        .btn-danger {
            background-color: #c62828; /* Mengatur warna latar belakang tombol menjadi merah */
            color: white; /* Mengatur warna teks tombol menjadi putih */
            border: none; /* Menghilangkan border pada tombol */
        }

        /* Gaya hover untuk tombol .btn-danger */
        .btn-danger:hover {
            background-color: #791616; /* Mengubah warna latar belakang tombol saat dihover menjadi merah lebih gelap */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Data Logbook untuk {{ $students->name }}</h2>

        <!-- Pesan Sukses -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <a href="{{ route('admin.kegiatan.activity', ['id' => $students->id]) }}" class="btn btn-success mb-3" style="width: 20%;">Download</a>
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-head text-center">
                <tr>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Kegiatan</th>
                    <th>Bukti Kegiatan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="table-tbody">
                @foreach ($kegiatans as $kegiatan)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $kegiatan->waktu_mulai }}</td>
                    <td>{{ $kegiatan->waktu_selesai }}</td>
                    <td>{{ $kegiatan->kegiatan }}</td>
                    <td>
                        <!-- Menampilkan foto bukti kegiatan jika ada -->
                        @if($kegiatan->foto)
                        <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="Bukti Kegiatan" class="img-fluid"
                            style="max-height: 100px;">
                        @else
                        Tidak ada foto
                        @endif
                    </td>
                    <td class="text-center">
                        @if($kegiatan->status == 'acc')
                        <span class="text-success">Sudah Diterima (ACC)</span>
                        @elseif($kegiatan->status == 'revisi')
                        <span class="text-danger">Perlu Revisi</span>
                        @else
                        <span class="text-warning">Menunggu Validasi</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary">Kembali ke Daftar Kegiatan</a>
        </div>
    </div>
</body>

</html>
