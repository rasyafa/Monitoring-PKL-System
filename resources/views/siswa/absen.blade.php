@extends('layouts.siswa')  <!-- Menggunakan layout yang sudah disediakan dengan nama 'siswa' -->

@section('content') <!-- Bagian ini adalah konten utama halaman yang akan di-render -->

    <title>Absen Hari Ini</title> <!-- Judul halaman -->

    <style>
        /* Styling CSS untuk elemen-elemen halaman */
        body {
            background-color: #f4f6f9; /* Warna latar belakang halaman */
        }

        .card {
            border-radius: 10px; /* Membuat sudut-sudut card melengkung */
        }

        .btn-back {
            background-color: #6c757d; /* Warna tombol kembali */
            color: white; /* Warna teks tombol */
        }

        .btn-back:hover {
            background-color: #5a6268; /* Efek hover pada tombol kembali */
        }

        .table th,
        .table td {
            vertical-align: middle; /* Menyelaraskan teks pada tabel agar berada di tengah */
        }

        .card-header {
            background-color: #03d703; /* Warna latar belakang header card */
            color: white; /* Warna teks pada header card */
            text-align: center; /* Teks header card diratakan ke tengah */
            font-size: 1.25rem; /* Ukuran font untuk header */
        }

        .alert {
            border-radius: 10px; /* Membuat sudut-sudut alert melengkung */
        }

        .btn-absen {
            background-color: #03d703; /* Warna tombol absen */
            color: white; /* Warna teks tombol */
            border: none; /* Menghilangkan border pada tombol */
        }

        .btn-absen:hover {
            background-color: #029b02; /* Efek hover pada tombol absen */
        }

        /* Styling untuk input checkbox/radio button */
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
            background-color: #03d703; /* Warna saat checkbox/radio button dipilih */
            border-color: #03d703; /* Border saat dipilih */
        }

        .form-check-input:checked::after {
            content: '';
            position: absolute;
            top: 4px;
            left: 4px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: white; /* Bulatan putih saat dipilih */
        }

        .form-check-label {
            color: #333; /* Warna teks label */
            font-size: 1rem; /* Ukuran font label */
            margin-left: 10px; /* Memberikan jarak antara checkbox dan label */
            transition: color 0.2s ease;
        }

        .form-check-input:checked + .form-check-label {
            color: #03d703; /* Mengubah warna label ketika checkbox dipilih */
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

    <div class="container mt-4"> <!-- Container utama dengan margin atas -->

        <!-- Menampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }} <!-- Pesan sukses -->
            </div>
        @endif

        <!-- Menampilkan pesan error jika ada -->
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }} <!-- Pesan error -->
        </div>
        @endif

        <!-- Menampilkan daftar error jika ada -->
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error) <!-- Menampilkan semua error -->
            <p>{{ $error }}</p> <!-- Setiap error ditampilkan dalam paragraf -->
            @endforeach
        </div>
        @endif

        <!-- Form untuk absensi -->
        <div class="card shadow-lg p-4 mb-5">
            <div class="card-header">
                <h4>Absen Hari Ini</h4> <!-- Judul untuk form absen -->
            </div>
            <form action="{{ route('siswa.absen.store') }}" method="POST"> <!-- Form untuk mengirim data absen -->
                @csrf <!-- Token untuk proteksi CSRF -->
                <div class="mb-3">
                    <label for="user_name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="user_name" value="{{ auth()->user()->name }}" disabled>
                    <!-- Menampilkan nama pengguna yang sedang login, tidak dapat diubah -->
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                        value="{{ now()->toDateString() }}" disabled>
                    <!-- Menampilkan tanggal hari ini, tidak dapat diubah -->
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Kehadiran</label>
                    <div class="status-kehadiran">
                        <!-- Radio buttons untuk memilih status kehadiran -->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="hadir" value="Hadir" checked>
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

                <button type="submit" class="btn btn-absen me-2">Absen</button> <!-- Tombol untuk mengirim form absen -->
            </form>
        </div>

        <!-- Menampilkan riwayat absen -->
        <h4 class="mb-4">Riwayat Absen</h4>
        <div class="card shadow-sm p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absens as $absen) <!-- Looping untuk menampilkan semua data absen -->
                    <tr>
                        <td>{{ $absen->user->name }}</td> <!-- Menampilkan nama pengguna -->
                        <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td> <!-- Menampilkan tanggal absen dengan format dd-mm-yyyy -->
                        <td>{{ $absen->status }}</td> <!-- Menampilkan status kehadiran -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Menambahkan Bootstrap JS untuk fungsi interaktif -->
@endsection
