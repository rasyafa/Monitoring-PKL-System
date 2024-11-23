<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan Harian - Logbook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        h2 {
            font-weight: bold;
            color: #505050;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #0ccf4d;
            color: #fff;
        }

        .btn-success {
            background-color: #17d033;
            color: 212529;
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
