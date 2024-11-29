@extends('layouts.admin')

@section('title', 'Data Absen')

@section('page-title', 'Data Absensi')

@section('content')
<style>

        /* Menyusun tampilan judul h2 */
        h2 {
            background-color: transparent; /* Tidak ada warna latar belakang */
            font-size: 1.5rem; /* Ukuran font judul */
            font-weight: bold; /* Menebalkan font */
            color: #333; /* Warna teks */
            padding: 5px; /* Memberikan ruang di sekitar teks */
            border-bottom: none; /* Menghilangkan border bawah */
        }

        /* Styling untuk tabel */
        .table {
            background-color: #f9f9f9; /* Warna latar belakang tabel */
            table-layout: fixed; /* Mengatur kolom agar memiliki ukuran tetap sesuai lebar */
        }

        /* Styling untuk card agar lebih rapi */
        .card {
            margin-top: 20px; /* Memberikan jarak dari elemen di atasnya */
            padding: 20px; /* Memberikan ruang di dalam card */
            border: 1px solid #ffffff; /* Border berwarna putih */
            border-radius: 5px; /* Membuat sudut card menjadi melengkung */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Bayangan lembut di bawah card */
        }

        /* Styling untuk header tabel (th) */
        th {
            background-color: #3dd83d !important; /* Warna latar belakang header tabel */
            color: white !important; /* Warna teks putih pada header tabel */
            text-align: center; /* Menyelaraskan teks ke tengah */
        }

        /* Menambahkan responsivitas pada tabel */
        .table-responsive {
            rflow-x: auto; /* Membuat tabel dapat digulir secara horizontal jika terlalu lebar */
        }
        </style>

<div class="container">
    <div class="card">
        <h2 class="mb-4">Rekap Kehadiran Siswa</h2>
        <a href="{{ route('admin.absen.attendance') }}" class="btn btn-success mb-3" style="width: 20%;">Download PDF</a>
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
