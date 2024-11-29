@extends('layouts.pembimbing')

@section('title', 'Laporan Akhir')

@section('page-title', 'Laporan Akhir')

@section('content')
<div class="container mt-4">

    <div class="row">
        <!-- Card untuk semua laporan -->
        <div class="col-md-12 mb-4">
            <div class="card" style="border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <!-- Judul Laporan Akhir -->
                    <h3 class="text-center mb-4">Laporan Akhir {{ $students->name }}</h3>

                    <!-- Cek jika ada laporan -->
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>Tanggal</th>
                                <th>Judul Laporan</th>
                                <th>File</th>
                                <th>Link Laporan</th>
                                <th>Status</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporans as $laporan)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $laporan->judul }}</td>
                                <td>
                                    <a href="{{ Storage::url($laporan->file_path) }}" class="btn btn-link"
                                        target="_blank">
                                        {{ basename($laporan->file_path) }}
                                    </a>
                                </td>
                                <td><a href="{{ Storage::url($laporan->link_laporan) }}" class="btn btn-link"
                                        target="_blank">
                                        {{ basename($laporan->link_lap) }}
                                    </a></td>
                                <td class="text-center">
                                    @if($laporan->status == 'acc')
                                    <span class="text-success">Sudah Diterima (ACC)</span>
                                    @elseif($laporan->status == 'revisi')
                                    <span class="text-danger">Perlu Revisi</span>
                                    @else
                                    <span class="text-warning">Menunggu Validasi</span>
                                    @endif
                                </td>
                                <td>{{ $laporan->catatan ?? 'Tidak ada catatan' }}</td>
                                <td class="text-center">
                                    <!-- Tombol ACC -->
                                    <form action="{{ route('pembimbing.laporan.updateStatus', $laporan->id) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="status" value="acc">
                                        <button type="submit" class="btn btn-success btn-sm" {{ $laporan->status ==
                                            'acc' ? 'disabled' : '' }}>
                                            ACC
                                        </button>
                                    </form>

                                    <!-- Tombol Revisi -->
                                    <button class="btn btn-danger btn-sm"
                                        onclick="showRevisiModal({{ $laporan->id }}, '{{ $laporan->catatan }}')">
                                        Revisi
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada laporan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Form Catatan -->
<div class="modal fade" id="modalRevisi" tabindex="-1" aria-labelledby="modalRevisiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="revisiForm" method="POST" action="">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRevisiLabel">Form Catatan Revisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea name="catatan" id="catatan" rows="4" class="form-control"
                            placeholder="Masukkan catatan untuk revisi"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk mengontrol modal -->
<script>
    function showRevisiModal(laporanId, currentCatatan) {
        const modal = new bootstrap.Modal(document.getElementById('modalRevisi'));
        const revisiForm = document.getElementById('revisiForm');
        const catatanField = document.getElementById('catatan');

        // Set action form dan isi catatan
        revisiForm.action = `/pembimbing/laporan/${laporanId}/updateCatatan`;
        catatanField.value = currentCatatan || '';

        modal.show();
    }
</script>

<!-- Tambahkan gaya khusus -->
<style>
    :root {
        --main-bg-color: #03d703;
        --main-text-color: #03d703;
        --second-text-color: #686868;
        --second-bg-color: #fff;
        --toggle-color: #03d703;
        --heading-color: #03d703;
    }

    /* Ubah warna tombol menjadi #03d703 */
    button.btn-primary {
        background-color: #03d703 !important;
        border-color: #03d703 !important;
    }

    /* Gaya untuk tabel */
    .table th,
    .table td {
        color: #6c757d !important;
        padding: 15px !important;
    }

    .table-bordered {
        border: 1px solid #ddd !important;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ddd !important;
    }
</style>
@endsection
