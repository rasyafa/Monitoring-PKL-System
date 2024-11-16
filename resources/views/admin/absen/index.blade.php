@extends('layouts.admin')

@section('title', 'Data Absen')

@section('page-title', 'Data Absensi')

@section('content')
<style>
    body {
        background-color: #f9fafb;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 100%;
        padding: 20px;
        margin: auto;
    }

    .card {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    h2 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #16bb40;
        text-align: center;
        margin-bottom: 20px;
    }

    .table-responsive {
        overflow-x: auto;
        /* Untuk layar kecil, memungkinkan scroll horizontal */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    thead {
        background-color: #007bff;
        color: white;
    }

    th,
    td {
        text-align: center;
        padding: 12px;
        border: 1px solid #dee2e6;
        word-wrap: break-word;
    }

    tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }

    tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    tbody tr:hover {
        background-color: #e9ecef;
        cursor: pointer;
    }

    /* Highlight status attendance */
    td {
        font-size: 14px;
        vertical-align: middle;
    }

    td:contains('Hadir') {
        color: #1bc84e;
        font-weight: bold;
    }

    td:contains('Sakit') {
        color: #ffc107;
        font-weight: bold;
    }

    td:contains('Izin') {
        color: #17a2b8;
        font-weight: bold;
    }

    td:contains('Absen') {
        color: #dc3545;
        font-weight: bold;
    }

    td:contains('?') {
        color: #6c757d;
        font-style: italic;
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
