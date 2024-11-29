<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rekap Kehadiran</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
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
