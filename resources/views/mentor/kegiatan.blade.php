<!-- resources/views/logbook.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 80%;
            margin: 20px 0;
        }

        .table-container {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .table-container th,
        .table-container td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table-container th {
            background-color: #32cd32;
            color: white;
        }

        .table-container td a {
            color: #32cd32;
            text-decoration: none;
        }

        .table-container td a:hover {
            text-decoration: underline;
        }

        h2 {
            text-align: center;
            margin: 10px 0;
            color: rgb(50, 50, 50);
        }

    </style>
</head>

<body>
    <div class="container">
        <h2>Kegiatan Siswa</h2>
        <table class="table-container">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user['nama'] }}</td>
                        <td>
                            <!-- Link ke halaman detail kegiatan -->
                            <a href="{{ route('mentor.detailKegiatan', ['id' => $index + 1]) }}">Lihat laporan {{ $user['nama'] }}</a>
                        </td>
                    </tr>
                @endforeach
</tbody>

        </table>
    </div>
</body>

</html>
