<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kegiatan Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

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

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table thead {
            background-color: #f8f9fa;
            color: #495057;
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Riwayat Kegiatan Harian</h1>


        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
        @endif


        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatans as $kegiatan)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $kegiatan->waktu_mulai }}</td>
                            <td>{{ $kegiatan->waktu_selesai }}</td>
                            <td>{{ $kegiatan->kegiatan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-start">
                <a href="{{ route('siswa.kegiatan.create') }}" class="btn btn-custom me-2">Tambah Kegiatan</a>
                <a href="{{ route('siswa.beranda') }}" class="btn btn-secondary-custom">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
