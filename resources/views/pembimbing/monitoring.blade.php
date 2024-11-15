<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kegiatan Pembimbing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f1f1;
            font-family: sans-serif;
        }

        .container {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

         .btn-custom {
            background-color: #03d703;
            border-color: #03d703;
            color: white;
        }

        .btn-custom:hover {
            background-color: #028d02;
            border-color: #028d02;
        }

        .btn-secondary-custom {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        .btn-secondary-custom:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        h2,
        .table th,
        .table td {
            color: black;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .form-container {
            display: inline-block;
        }

        .form-container textarea {
            resize: none;
            width: 100%;
            height: 100px;
        }

        /* Styling untuk tombol agar posisinya di sebelah kanan */
        .btn-container {
            text-align: right;
            margin-bottom: 20px;
        }
        /* Style untuk pagination */
       .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item.active .page-link {
            background-color: #17d033;
            border-color: #17d033;
            color: white;
        }

        .pagination .page-item .page-link {
            color: #17d033;
            border: 1px solid #17d033;
        }

        .pagination .page-item:hover .page-link {
            background-color: #169e28;
            border-color: #169e28;
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
            border-color: #ccc;
        }

        .pagination .page-item .page-link {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Kegiatan Pembimbing</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tombol Tambah dan kembali -->
            <div class="btn-container">
                <a href="{{ route('pembimbing.create') }}" class="btn btn-custom me-2">Tambah Kegiatan</a>
                <a href="{{ route('pembimbing.home') }}" class="btn btn-secondary-custom">Kembali</a>
            </div>

        <!-- Tabel Responsif -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatan as $data)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                        <td>
                            <!-- Menggunakan textarea untuk kegiatan, agar bisa diedit -->
                            <textarea class="form-control" rows="4" disabled>{{ $data->kegiatan }}</textarea>
                        </td>
                        <td><img src="{{ asset('storage/gambar/' . $data->image) }}" width="100"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $kegiatan->links() }}
            <!-- pagination -->

        </div> <!-- End of .table-responsive -->
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
