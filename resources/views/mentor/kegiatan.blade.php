<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Logbook</title>
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
        <h2>Data Logbook</h2>
        <table class="table-container">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Hilma Fitri Solehah</td>
                    <td><a href="#link1">Lihat laporan Hilma Fitri Solehah</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Yehezkiel Frederick Ruru</td>
                    <td><a href="#link2">Lihat laporan Yehezkiel Frederick Ruru</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Hana Hanifah</td>
                    <td><a href="#link3">Lihat laporan Hana Hanifah</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>