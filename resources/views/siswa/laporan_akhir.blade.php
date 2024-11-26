@extends('layouts.siswa') <!-- Menggunakan layout 'siswa' sebagai template utama -->

@section('content') <!-- Memulai bagian konten halaman yang akan dimasukkan ke dalam layout -->

<!-- Kontainer utama halaman dengan margin atas -->
<div class="container mt-4">
    <!-- Tombol untuk membuka modal kirim laporan -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#kirimLaporanModal">
        Kirim Laporan
    </button>

    <!-- Menampilkan notifikasi sukses jika ada pesan dari session -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="alertSuccess">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Menampilkan notifikasi error jika ada pesan dari session -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" id="alertError">
            <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Card untuk menampilkan laporan yang telah ada -->
        <div class="col-md-12 mb-4">
            <div class="card" style="border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <!-- Judul bagian laporan akhir -->
                    <h3 class="text-center mb-4">Laporan Akhir</h3>

                    <!-- Menampilkan laporan jika ada, jika kosong akan menampilkan pesan -->
                    @forelse($laporans as $laporan)
                    <table class="table table-bordered" style="border-radius: 10px;">
                        <thead>
                            <!-- Menampilkan nama user (yang mengirim laporan) -->
                            <tr style="background-color: #f7f7f7;">
                                <th><strong>Nama</strong></th>
                                <th>{{ Auth::user()->name }}</th>
                            </tr>
                            <!-- Menampilkan tanggal laporan -->
                            <tr style="background-color: #fafafa;">
                                <th><strong>Tanggal</strong></th>
                                <th>{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d-m-Y') }}</th>
                            </tr>
                            <!-- Menampilkan judul laporan -->
                            <tr style="background-color: #f7f7f7;">
                                <th><strong>Judul Laporan</strong></th>
                                <th>{{ $laporan->judul }}</th>
                            </tr>
                            <!-- Menampilkan status laporan dengan badge -->
                            <tr style="background-color: #f7f7f7;">
                                <th><strong>Status</strong></th>
                                <th>
                                    @if($laporan->status === 'acc')
                                        <span class="badge bg-success">ACC</span>
                                    @elseif($laporan->status === 'revisi')
                                        <span class="badge bg-warning text-dark">Revisi</span>
                                    @else
                                        <span class="badge bg-secondary">Menunggu Validasi</span>
                                    @endif
                                </th>
                            </tr>
                            <!-- Catatan Pembimbing -->
                            @if($laporan->catatan)
                            <tr style="background-color: #fafafa;">
                                <th><strong>Catatan Pembimbing</strong></th>
                                <th>{{ $laporan->catatan }}</th>
                            </tr>

                            <!-- Menampilkan file laporan yang diupload -->
                            @endif
                            <tr style="background-color: #fafafa;">
                                <th><strong>File</strong></th>
                                <th>
                                    <!-- Link untuk membuka file laporan -->
                                    <a href="{{ Storage::url($laporan->file_path) }}" class="btn btn-link" target="_blank">
                                        {{ basename($laporan->file_path) }} <!-- Menampilkan nama file -->
                                    </a>
                                </th>
                            </tr>
                            <!-- Menampilkan tombol hapus untuk laporan -->
                            <tr style="background-color: #f7f7f7;">
                                <td colspan="2" class="text-center">
                                    <form action="{{ route('laporan.hapus', $laporan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="showToast('Laporan berhasil dihapus!')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        </thead>
                    </table>
                    @empty
                    <p class="text-center">Belum ada laporan. Silakan kirim laporan menggunakan tombol di atas.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk mengirim laporan -->
<div class="modal fade" id="kirimLaporanModal" tabindex="-1" aria-labelledby="kirimLaporanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('laporan.simpan') }}" method="POST" enctype="multipart/form-data" onsubmit="showToast('Laporan sedang dikirim...')">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="kirimLaporanLabel">Kirim Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input untuk nama, yang diambil dari data user yang login -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <!-- Input untuk tanggal laporan, yang diset otomatis ke tanggal hari ini -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ now()->toDateString() }}" disabled>
                    </div>
                    <!-- Input untuk judul laporan -->
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Laporan</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <!-- Input untuk mengunggah file laporan -->
                    <div class="mb-3">
                        <label for="file" class="form-label">Unggah File</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk menampilkan toast notification -->
<script>
    function showToast(message) {
        // Cek apakah ada alert yang sudah tampil
        if (document.getElementById('alertSuccess') || document.getElementById('alertError')) {
            return; // Mencegah tampilan toast jika sudah ada alert
        }

        let toastElement = document.createElement('div');
        toastElement.classList.add('toast');
        toastElement.classList.add('align-items-center');
        toastElement.classList.add('text-white');
        toastElement.classList.add('bg-success');
        toastElement.classList.add('border-0');
        toastElement.classList.add('position-fixed');
        toastElement.classList.add('top-0');
        toastElement.classList.add('end-0');
        toastElement.style.zIndex = '9999'; // Agar toast tampil di atas
        toastElement.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
            </div>
        `;

        document.body.appendChild(toastElement);
        let toast = new bootstrap.Toast(toastElement);
        toast.show();

        setTimeout(() => {
            toastElement.remove(); // Toast hilang setelah 10 detik
        }, 10000);
    }
</script>

<!-- Tambahkan gaya khusus -->
<style>
/* Mengubah warna tombol kirim menjadi hijau */
button.btn-primary {
    background-color: #03d703 !important;
    border-color: #03d703 !important;
}

/* Ubah warna teks di dalam tabel menjadi abu-abu */
.table th, .table td {
    color: #6c757d !important; /* Abu-abu */
}

/* Tambahkan jarak antar elemen di dalam tabel */
.table th, .table td {
    padding: 15px !important; /* Menambah jarak */
}
</style>

@endsection <!-- Menandakan akhir bagian konten yang dimasukkan dalam layout -->
