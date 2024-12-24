@extends('layouts.siswa') <!-- Menggunakan layout siswa yang sudah didefinisikan, memastikan tampilan sesuai dengan desain aplikasi -->

@section('content') <!-- Menandai mulai bagian konten untuk halaman ini -->

    <title>Riwayat Laporan Harian</title> <!-- Mengatur title halaman untuk Riwayat Kegiatan Harian -->

    <!-- Memasukkan script SweetAlert2 untuk menampilkan notifikasi pop-up -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Custom styling untuk tombol kirim laporan yang berwarna hijau */
        .btn-custom {
            background-color: #03d703;
            border-color: #03d703;
            color: white;
        }

        /* Efek hover untuk tombol custom yang berubah menjadi hijau lebih gelap */
        .btn-custom:hover {
            background-color: #028d02;
            border-color: #028d02;
        }

        /* Custom styling untuk tombol kedua dengan warna abu-abu */
        .btn-secondary-custom {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        /* Efek hover untuk tombol kedua yang berubah warna menjadi abu-abu gelap */
        .btn-secondary-custom:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        /* Menyelaraskan isi kolom tabel menjadi rata tengah secara vertikal dan horizontal */
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        /* Memberikan warna latar belakang khusus pada header tabel */
        .table thead {
            background-color: #f8f9fa;
            color: #495057;
        }

        /* Memberikan efek hover pada baris tabel dengan latar belakang lebih terang */
        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }

        /* Styling pagination (navigasi halaman) di bawah tabel agar lebih rapi dan terpusat */
        .pagination {
            justify-content: center;
            display: flex;
            margin: 20px 0;
        }

        /* Custom styling untuk link halaman pagination */
        .pagination .page-link {
            background-color: #ffffff;
            color: #000;
        }

        /* Custom styling untuk link pagination yang aktif */
        .pagination .active .page-link {
            background-color: #03d703;
            color: #000;
        }
    </style>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Riwayat Laporan Harian</h1>

        <!-- Menampilkan notifikasi SweetAlert jika ada session success -->
        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000 // Notifikasi akan hilang setelah 2 detik
                });
            </script>
        @endif

        <!-- Tabel untuk menampilkan riwayat kegiatan -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Kegiatan</th>
                        <th>Bukti Kegiatan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping untuk menampilkan setiap kegiatan -->
                    @foreach ($kegiatans as $kegiatan)
                        <tr>
                            <!-- Menampilkan tanggal kegiatan dalam format dd-mm-yyyy -->
                            <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y') }}</td>
                            <!-- Menampilkan waktu mulai kegiatan -->
                            <td>{{ $kegiatan->waktu_mulai }}</td>
                            <!-- Menampilkan waktu selesai kegiatan -->
                            <td>{{ $kegiatan->waktu_selesai }}</td>
                            <!-- Menampilkan deskripsi kegiatan -->
                            <td>{{ $kegiatan->kegiatan }}</td>
                            <td>
                                <!-- Menampilkan foto bukti kegiatan jika ada -->
                                @if($kegiatan->foto)
                                    <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="Bukti Kegiatan" class="img-fluid" style="max-height: 100px;">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td>
                                <!-- Menampilkan status kegiatan dengan badge warna berbeda -->
                                @if($kegiatan->status === 'acc')
                                    <span class="badge bg-success">ACC</span>
                                @else
                                    <span class="badge bg-secondary">Menunggu Validasi</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tombol untuk menambah kegiatan baru -->
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-start">
                <a href="{{ route('siswa.kegiatan.create') }}" class="btn btn-custom me-2">Tambah Laporan Harian</a>
            </div>
        </div>
    </div>

    <!-- Navigasi halaman pagination untuk menampilkan halaman berikutnya atau sebelumnya -->
    <div class="pagination">
        {{ $kegiatans->links() }}
    </div>

    <!-- Script untuk memuat Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection <!-- Menandai akhir dari bagian content halaman ini -->
