<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan</title>
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

        h3 {
            text-align: center;
            margin: 10px 0;
            color: rgb(50, 50, 50);
        }

        .button {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            cursor: pointer;
        }

        .confirm-btn {
            background-color: #32cd32;
            color: white;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Detail Kegiatan</h3>
        <table class="table-container">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Kegiatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $kegiatanDetail['id'] }}</td>
                    <td>{{ $kegiatanDetail['tanggal'] }}</td>
                    <td>{{ $kegiatanDetail['waktu_mulai'] }}</td>
                    <td>{{ $kegiatanDetail['waktu_selesai'] }}</td>
                    <td>{{ $kegiatanDetail['kegiatan'] }}</td>
                    <td>
                        <a href="confirm_page_{{ $kegiatanDetail['id'] }}.html">
                            <button class="button confirm-btn">Konfirmasi</button>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>