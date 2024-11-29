<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan Harian - Logbook</title>
    <style>
       /* Mengatur gaya keseluruhan untuk elemen body */
        body {
            font-family: Arial, sans-serif; /* Menggunakan font Arial */
            margin: 20px; /* Memberikan margin sekitar 20px pada seluruh halaman */
            color: #333; /* Warna teks utama berwarna abu-abu gelap */
        }

        /* Gaya untuk judul h2 */
        h2 {
            font-weight: bold;
            color: #505050;
            text-align: center;
            margin-bottom: 20px; 
        }

        /* Gaya untuk tabel */
        table {
            width: 100%; /* Tabel mengisi seluruh lebar halaman */
            border-collapse: collapse; /* Menggabungkan border antar sel */
            margin-top: 20px; /* Memberikan jarak 20px di atas tabel */
        }

        /* Gaya untuk header dan sel tabel */
        th,
        td {
            padding: 8px 12px; /* Memberikan padding di dalam sel */
            text-align: left; /* Menyelaraskan teks di kiri dalam sel */
            border: 1px solid #ddd; /* Border tipis dengan warna abu-abu */
        }

        /* Gaya khusus untuk header tabel */
        th {
            background-color: #0ccf4d; /* Warna latar belakang hijau untuk header */
            color: #fff; /* Warna teks putih pada header */
        }

        /* Gaya untuk tombol dengan kelas .btn-success */
        .btn-success {
            background-color: #17d033; /* Warna latar belakang hijau */
            color: 212529; /* Warna teks gelap */
        }
    </style>
</head>

<body>
    <h2>Data Logbook untuk {{ $students->name }}</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Kegiatan</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kegiatans as $kegiatan)
            <tr>
                <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $kegiatan->waktu_mulai }}</td>
                <td>{{ $kegiatan->waktu_selesai }}</td>
                <td>{{ $kegiatan->kegiatan }}</td>
                <td>
                    @if($kegiatan->status == 'acc')
                    <span style="color: green;">Sudah Diterima (ACC)</span>
                    @elseif($kegiatan->status == 'revisi')
                    <span style="color: red;">Perlu Revisi</span>
                    @else
                    <span style="color: orange;">Menunggu Validasi</span>
                    @endif
                </td>
                <td>
                    @if($kegiatan->catatan)
                    {{ $kegiatan->catatan }}
                    @else
                    <span style="color: #888;">Tidak ada catatan</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
