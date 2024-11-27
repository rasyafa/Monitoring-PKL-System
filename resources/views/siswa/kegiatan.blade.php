@extends('layouts.siswa') <!-- Menggunakan layout 'siswa' sebagai template utama -->

@section('content') <!-- Memulai bagian konten halaman yang akan ditampilkan di dalam layout -->

    <title>Riwayat Kegiatan Harian</title> <!-- Judul halaman yang ditampilkan di tab browser -->

    <!-- Menyertakan pustaka SweetAlert2 untuk menampilkan notifikasi alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Gaya untuk tombol dengan warna khusus */
        .btn-custom {
            background-color: #03d703; /* Warna hijau untuk tombol */
            border-color: #03d703;
            color: white;
        }

        /* Efek hover untuk tombol khusus */
        .btn-custom:hover {
            background-color: #028d02; /* Warna lebih gelap saat hover */
            border-color: #028d02;
        }

        /* Gaya untuk tombol sekunder */
        .btn-secondary-custom {
            background-color: #6c757d; /* Warna abu-abu untuk tombol */
            border-color: #6c757d;
            color: white;
        }

        /* Efek hover untuk tombol sekunder */
        .btn-secondary-custom:hover {
            background-color: #5a6268; /* Warna lebih gelap saat hover */
            border-color: #5a6268;
        }

        /* Penataan untuk tabel, memastikan teks di tengah */
        .table th, .table td {
            vertical-align: middle; /* Menyusun teks secara vertikal di tengah */
            text-align: center; /* Menyusun teks secara horizontal di tengah */
        }

        /* Penataan untuk bagian kepala tabel */
        .table thead {
            background-color: #f8f9fa; /* Warna latar belakang kepala tabel */
            color: #495057; /* Warna teks di kepala tabel */
        }

        /* Efek hover pada baris tabel */
        .table-hover tbody tr:hover {
            background-color: #e9ecef; /* Warna latar belakang baris saat hover */
        }

        /* Menata tampilan pagination (halaman navigasi tabel) */
        .pagination {
            justify-content: center; /* Menyusun pagination di tengah */
            display: flex;
            margin: 20px 0; /* Memberikan margin atas dan bawah pada pagination */
        }

        /* Gaya untuk tautan halaman pagination */
        .pagination .page-link {
            background-color: #ffffff; /* Warna latar belakang tautan */
            color: #000; /* Warna teks tautan */
        }

        /* Gaya untuk tautan halaman yang aktif */
        .pagination .active .page-link {
            background-color: #03d703; /* Warna hijau untuk halaman yang aktif */
            color: #000; /* Warna teks halaman aktif */
        }
    </style>

    <div class="container mt-5"> <!-- Menampilkan konten dalam container dengan margin atas -->
        <h1 class="text-center mb-4">Riwayat Kegiatan Harian</h1> <!-- Judul halaman, disusun di tengah -->

        <!-- Menampilkan notifikasi sukses jika ada pesan dari session -->
        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',  /* Jenis notifikasi (icon) */
                    title: 'Sukses!', /* Judul notifikasi */
                    text: '{{ session('success') }}', /* Pesan yang ditampilkan */
                    showConfirmButton: false, /* Menghilangkan tombol konfirmasi */
                    timer: 2000 /* Waktu notifikasi ditampilkan selama 2 detik */
                });
            </script>
        @endif

        <!-- Menampilkan tabel riwayat kegiatan harian -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th> <!-- Kolom untuk Tanggal -->
                        <th>Waktu Mulai</th> <!-- Kolom untuk Waktu Mulai -->
                        <th>Waktu Selesai</th> <!-- Kolom untuk Waktu Selesai -->
                        <th>Kegiatan</th> <!-- Kolom untuk Kegiatan -->
                        <th>Status</th> <!-- Kolom untuk Status -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping untuk menampilkan setiap kegiatan -->
                    @foreach ($kegiatans as $kegiatan)
                        <tr>
                            <!-- Menampilkan tanggal kegiatan dalam format d-m-Y -->
                            <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y') }}</td>
                            <!-- Menampilkan waktu mulai kegiatan -->
                            <td>{{ $kegiatan->waktu_mulai }}</td>
                            <!-- Menampilkan waktu selesai kegiatan -->
                            <td>{{ $kegiatan->waktu_selesai }}</td>
                            <!-- Menampilkan nama kegiatan -->
                            <td>{{ $kegiatan->kegiatan }}</td>
                             <td>
                                @if($kegiatan->status === 'acc')
                                    <span class="badge bg-success">ACC</span>
                                @elseif($kegiatan->status === 'revisi')
                                    <span class="badge bg-warning text-dark"> Revisi</span>
                                @else
                                    <span class="badge bg-secondary">Menunggu Validasi</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Menambahkan tombol untuk menambah kegiatan baru -->
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-start">
                <a href="{{ route('siswa.kegiatan.create') }}" class="btn btn-custom me-2">Tambah Kegiatan</a> <!-- Tombol untuk menambah kegiatan -->
            </div>
        </div>
    </div>

    <!-- Menampilkan navigasi pagination -->
    <div class="pagination">
        {{ $kegiatans->links() }} <!-- Menampilkan pagination sesuai dengan data yang ada -->
    </div>

    <!-- Menyertakan Bootstrap JS untuk interaktivitas jika diperlukan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection <!-- Mengakhiri bagian konten yang akan dimasukkan ke dalam layout -->
