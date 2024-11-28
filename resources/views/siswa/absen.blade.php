@extends('layouts.siswa')

@section('content')

    <title>Absen Hari Ini</title>
    <style>
        body {
            background-color: #f4f6f9;
        }

        .card {
            border-radius: 10px;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .card-header {
            background-color: #03d703;
            color: white;
            text-align: center;
            font-size: 1.25rem;
        }

        .alert {
            border-radius: 10px;
        }

        .btn-absen {
            background-color: #03d703;
            color: white;
            border: none;
        }

        .btn-absen:hover {
            background-color: #029b02;
        }

        .form-check-input {
            appearance: none;
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            position: relative;
            transition: all 0.2s ease;
        }

        .form-check-input:checked {
            background-color: #03d703;
            border-color: #03d703;
        }

        .form-check-input:checked::after {
            content: '';
            position: absolute;
            top: 4px;
            left: 4px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: white;
        }

        .form-check-label {
            color: #333;
            font-size: 1rem;
            margin-left: 10px;
            transition: color 0.2s ease;
        }

        .form-check-input:checked+.form-check-label {
            color: #03d703;
        }

        .status-kehadiran {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .status-kehadiran .form-check {
            display: inline-block;
        }
    </style>

    <div class="container mt-4">

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Success or Error Message -->
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <!-- Form Card -->
        <div class="card shadow-lg p-4 mb-5">
            <div class="card-header">
                <h4>Absen Hari Ini</h4>
            </div>
            <form action="{{ route('siswa.absen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="user_name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="user_name" value="{{ auth()->user()->name }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                        value="{{ now()->toDateString() }}" disabled>
                </div>

                <!-- Upload Foto -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Kirim Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Kehadiran</label>
                    <div class="status-kehadiran">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="hadir" value="Hadir">
                            <label class="form-check-label" for="hadir">
                                Hadir
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="sakit" value="Sakit">
                            <label class="form-check-label" for="sakit">
                                Sakit
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="izin" value="Izin">
                            <label class="form-check-label" for="izin">
                                Izin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="alpha" value="Alpha">
                            <label class="form-check-label" for="alpha">
                                Alpha
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-absen me-2">Absen</button>
            </form>
        </div>

        <h4 class="mb-4">Riwayat Absen</h4>
        <div class="card shadow-sm p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Foto</th> <!-- Menambahkan kolom Foto -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absens as $absen)
                    <tr>
                        <td>{{ $absen->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $absen->status }}</td>
                        <td>
                            @if ($absen->foto)
                                <img src="{{ asset('storage/' . $absen->foto) }}" alt="Foto Absen" width="100">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
