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
                    <td>1</td>
                    <td>2024-11-13</td>
                    <td>08:00</td>
                    <td>10:00</td>
                    <td>Rapat Tim</td>
                    <td>
                        <a href="confirm_page_1.html">
                            <button class="button confirm-btn">Konfirmasi</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2024-11-13</td>
                    <td>10:30</td>
                    <td>12:00</td>
                    <td>Analisis Data</td>
                    <td>
                        <a href="confirm_page_2.html">
                            <button class="button confirm-btn">Konfirmasi</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>2024-11-13</td>
                    <td>13:00</td>
                    <td>15:00</td>
                    <td>Penyusunan Laporan</td>
                    <td>
                        <a href="confirm_page_3.html">
                            <button class="button confirm-btn">Konfirmasi</button>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>