@extends('layouts.pembimbing')

@section('title', 'Data Siswa')

@section('header', 'Data Siswa')

@section('content')

<style>
    :root {
            --main-bg-color: #03d703;
            --main-text-color: #03d703;
            --second-text-color: #686868;
            --second-bg-color: #fff;
            --toggle-color: #03d703;
            --heading-color: #03d703;
        }

    h2 {
        color: #2e7d32;
        /* Hijau */
    }

    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #e8f5e9;
        /* Baris hijau sangat terang */
    }

    .table-bordered thead {
        background-color: #ffffff;
        /* Header tabel putih */
        color: #2e7d32;
        /* Hijau tua untuk teks */
        border-bottom: 2px solid #2e7d32;
        /* Garis bawah header */
    }

    .btn-light-green {
        background-color: #66bb6a;
        /* Hijau cerah */
        color: white;
        border: none;
    }

    .btn-light-green:hover {
        background-color: #4caf50;
        /* Hijau lebih gelap saat hover */
    }

    .btn-danger {
        background-color: #ef5350;
        /* Merah */
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #d32f2f;
        /* Merah lebih gelap saat hover */
    }
</style>

<div class="container mt-5">
    <h2>Data Siswa</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <!-- Ganti dari $users menjadi $students -->
            <tr>
                <td>{{ $student->id }}</td> <!-- Ganti dari $user menjadi $student -->
                <td>{{ $student->name }}</td>
                <td>{{ $student->username }}</td>
                <td>{{ $student->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $students->links() }}
        <!-- Ganti dari $users menjadi $students -->
    </div>
</div>
@endsection
