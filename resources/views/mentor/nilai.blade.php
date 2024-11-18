<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Akhir Siswa</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Warna latar belakang untuk halaman */
        body {
            background-color: #f8f9fa;
        }

        /* Kontainer tabel */
        .table-container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Judul halaman */
        .table-container h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }

        /* Tampilan tabel */
        .table th {
            background-color: #03d703;
            color: white;
            text-align: center;
        }

        .table td,
        .table th {
            vertical-align: middle;
            text-align: center;
        }

        /* Hover pada baris tabel */
        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        /* Tombol kembali ke profil */
        .back-button {
            display: block;
            margin: 20px auto 0;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="table-container">
        <h2>Nilai Akhir Siswa</h2>

        <!-- Tabel Nilai Siswa -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai Akhir</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh Data Siswa -->
                    <tr>
                        <td>1</td>
                        <td>Ahmad Santoso</td>
                        <td>Matematika</td>
                        <td>85</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Nurhaliza</td>
                        <td>Bahasa Indonesia</td>
                        <td>78</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Budi Setiawan</td>
                        <td>Ilmu Pengetahuan Alam</td>
                        <td>92</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Lina Marlina</td>
                        <td>Bahasa Inggris</td>
                        <td>69</td>
                        <td>C</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tombol kembali ke halaman profil -->
        <div class="back-button">
            <a href="#" class="btn btn-secondary">Kembali ke Profil</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
