@extends('layouts.mentor')

@section('content')
<div class="container mt-4">
    <h2>Rekap Kegiatan Harian</h2>
    <table class="table table-striped table-hover table-bordered">
        <thead class="table-primary text-center">
            <tr>
                <th>Tanggal</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Kegiatan</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Action</th>
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
                    @if($kegiatan->status == 'acc')
                    <span class="text-success">Sudah Diterima (ACC)</span>
                    @elseif($kegiatan->status == 'revisi')
                    <span class="text-danger">Perlu Revisi</span>
                    @else
                    <span class="text-warning">Menunggu Validasi</span>
                    @endif
                </td>
                <td>{{ $kegiatan->catatan ?? 'Tidak ada catatan' }}</td>
                <td class="text-center">
                    <!-- Tombol ACC -->
                    <form action="{{ route('mentor.kegiatan.updateStatus', $kegiatan->id) }}" method="POST"
                        style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="status" value="acc">
                        <button type="submit" class="btn btn-success btn-sm" {{ $kegiatan->status == 'acc' ? 'disabled' : '' }}>
                            ACC
                        </button>
                    </form>

                    <!-- Tombol Revisi -->
                    <button class="btn btn-danger btn-sm" onclick="showRevisiModal({{ $kegiatan->id }}, '{{ $kegiatan->catatan }}')">
                        Revisi
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
    function showRevisiModal(kegiatanId, currentCatatan) {
        const modal = new bootstrap.Modal(document.getElementById('modalRevisi')); // Inisialisasi modal
        const revisiForm = document.getElementById('revisiForm');
        const catatanField = document.getElementById('catatan');

        // Set action form dan isi catatan
        revisiForm.action = `/mentor/kegiatan/${kegiatanId}/updateCatatan`;
        catatanField.value = currentCatatan || ''; // Isi catatan jika ada, kosongkan jika tidak ada

        modal.show(); // Tampilkan modal
    }
</script>
@endsection
