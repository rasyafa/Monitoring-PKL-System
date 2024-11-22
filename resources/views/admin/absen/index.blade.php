@extends('layouts.admin')

@section('title', 'Data Absen')

@section('page-title', 'Data Absensi')

@section('content')
<style>

        h2{
        background-color: transparent;
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        padding: 5px;
        border-bottom: none;
        }

        .table {
        background-color: #f9f9f9;/* Warna latar belakang tabel */
        table-layout: fixed; Kolom memiliki ukuran tetap sesuai lebar

        }

        /* Memberikan padding pada card */
        .card {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #ffffff;
        border-radius: px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Bayangan sangat ringan */
        }

        /* style untuk th */
        th {
        background-color: #3dd83d !important; /* Pastikan aturan ini prioritas */
        color: white !important;
        text-align: center;
        }

        /* Tambahan untuk tampilan tabel */
        .table-responsive {
        overflow-x: auto;
        }

</style>

<div class="container">
    <div class="card">
        <h2 class="mb-4">Rekap Kehadiran Siswa</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Alamat Surel</th>
                        <th>Sesi Diambil</th>
                        <th>Poin</th>
                        <th>Persentase</th>
                        <!-- Kolom sesi berdasarkan tanggal -->
                        @foreach ($attendances->unique('tanggal') as $attendance)
                        <th>{{ \Carbon\Carbon::parse($attendance->tanggal)->format('M d, hA') }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->total_sessions }}</td>
                        <td>{{ $student->present_sessions }} / {{ $student->total_sessions }}</td>
                        <td>{{ number_format($student->attendance_percentage, 1) }}%</td>
                        <!-- Tampilan untuk status kehadiran setiap sesi -->
                        @foreach ($attendances->unique('tanggal') as $attendance)
                        @php
                        $session = $attendances->where('user_id', $student->id)
                        ->where('tanggal', $attendance->tanggal)
                        ->first();
                        @endphp
                        <td>
                            @if ($session)
                            @if ($session->status == 'Hadir')
                            H ({{ $session->point ?? '2' }}/2)
                            @elseif ($session->status == 'Sakit')
                            S
                            @elseif ($session->status == 'Izin')
                            I
                            @else
                            A
                            @endif
                            @else
                            ?
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
