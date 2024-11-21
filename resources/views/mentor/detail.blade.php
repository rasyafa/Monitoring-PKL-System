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
                    <!-- Tombol ACC dan Revisi -->
                    <form action="{{ route('mentor.kegiatan.updateStatus', $kegiatan->id) }}" method="POST"
                        style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="status" value="acc">
                        <button type="submit" class="btn btn-success btn-sm" {{ $kegiatan->status == 'acc' ? 'disabled'
                            : '' }}>
                            ACC
                        </button>
                    </form>
                    <form action="{{ route('mentor.kegiatan.updateStatus', $kegiatan->id) }}" method="POST"
                        style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="status" value="revisi">
                        <button type="submit" class="btn btn-danger btn-sm" {{ $kegiatan->status == 'revisi' ?
                            'disabled' : '' }}>
                            Revisi
                        </button>
                    </form>
                </td>
                <td>
                    <!-- Form untuk menambah atau mengedit catatan -->
                    <form action="{{ route('mentor.kegiatan.updateCatatan', $kegiatan->id) }}" method="POST">
                        @csrf
                        <textarea name="catatan" rows="2" class="form-control"
                            placeholder="Masukkan catatan jika diperlukan">{{ $kegiatan->catatan }}</textarea>
                        <button type="submit" class="btn btn-warning btn-sm mt-2">Catatan</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
