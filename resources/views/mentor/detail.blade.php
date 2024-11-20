@extends('layouts.mentor') 

@section('content')
    <table class="table table-striped table-hover table-bordered">
        <thead class="table-primary text-center">
            <tr>
                <th>Tanggal</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Kegiatan</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Aksi</th>
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
                        <span class="text-success">Sudah Tervalidasi</span>
                    @elseif($kegiatan->status == 'revisi')
                        <span class="text-warning">Perlu Revisi</span>
                    @else
                        <span class="text-muted">Belum Diverifikasi</span>
                    @endif
                </td>
                <td class="text-center">
                    <!-- Form untuk menambah catatan -->
                    <form action="{{ route('admin.kegiatan.updateCatatan', $kegiatan->id) }}" method="POST">
                        @csrf
                        <textarea name="catatan" rows="2" class="form-control" placeholder="Masukkan catatan jika diperlukan">{{ $kegiatan->catatan }}</textarea>
                        <button type="submit" class="btn btn-warning btn-sm mt-2">Simpan Catatan</button>
                    </form>
                </td>
                <td class="text-center">
                    <!-- Form untuk validasi atau revisi -->
                    @if($kegiatan->status != 'acc')
                        <form action="{{ route('admin.kegiatan.validasi', $kegiatan->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Validasi</button>
                        </form>
                    @endif
                    @if($kegiatan->status != 'revisi')
                        <form action="{{ route('admin.kegiatan.revisi', $kegiatan->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm mt-2">Revisi</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
