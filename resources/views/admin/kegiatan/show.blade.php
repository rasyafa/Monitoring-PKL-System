<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }

        h2 {
            color: #3a3d3a;
            /* Hijau */
        }

        .table-primary {
            background-color: #ffffff;
            /* Hijau muda */
            color: #333;
        }

        .btn-info,
        .btn-warning {
            background-color: #ffc107;
            /* Hijau gelap */
            color: 212529;
            border: none;
        }

        .btn-info:hover,
        .btn-warning:hover {
            background-color: #ffc107;
            /* Hijau lebih gelap */
        }

        .btn-success {
            background-color: #17d033;
            /* Hijau gelap */
            color: 212529;
            border: none;
        }

        .btn-success:hover {
            background-color: #1b5e20;
            /* Hijau lebih gelap */
        }

        .btn-danger {
            background-color: #c62828;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #791616;
            /* Merah tua */
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

        <table class="table table-striped table-hover table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Kegiatan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kegiatans as $kegiatan)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $kegiatan->waktu_mulai }}</td>
                    <td>{{ $kegiatan->waktu_selesai }}</td>
                    <td>{{ $kegiatan->kegiatan }}</td>
                    <td class="text-center">
                        @if($kegiatan->status == 'pending')
                        <form action="{{ route('admin.kegiatan.validasi', $kegiatan->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Validasi</button>
                        </form>
                        @else
                        <span class="text-success">Sudah Tervalidasi</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary">Kembali ke Daftar Siswa</a>
        </div>
    </div>
</body>

</html>
