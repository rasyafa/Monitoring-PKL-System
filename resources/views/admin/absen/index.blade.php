@extends('layouts.admin')

@section('title', 'Data Absen')

@section('page-title', 'Data Absensi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Rekap Kehadiran Siswa</h2>
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
@endsection
