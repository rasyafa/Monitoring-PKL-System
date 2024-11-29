<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rekap Kehadiran</title>
    <style>
       <style>

        /* Menetapkan lebar tabel menjadi 100% dari lebar container */
        table {
            width: 100%;/* Menggabungkan border antara sel sehingga tidak ada jarak antar border */
            border-collapse: collapse;
        }

        /* Menambahkan border ke tabel, header tabel (th), dan sel tabel (td) */
        table,
        th,
        td {
            border: 1px solid black;/* Border berwarna hitam dengan ketebalan 1px */
        }

        /* Menetapkan padding di dalam sel dan header tabel agar lebih mudah dibaca */
        th,
        td {
            padding: 10px;/* Memberikan jarak 10px di dalam setiap sel */
            text-align: center;/* Menyelaraskan teks ke tengah di dalam sel */
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Rekap Kehadiran Siswa</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Total Sesi</th>
                <th>Hadir</th>
                <th>Persentase Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->total_sessions }}</td>
                <td>{{ $student->present_sessions }} / {{ $student->total_sessions }}</td>
                <td>{{ number_format($student->attendance_percentage, 1) }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
