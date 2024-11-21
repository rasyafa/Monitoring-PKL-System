@extends('layouts.pembimbing')

@section('title', 'Data Siswa')

@section('header', 'Data Siswa')

@section('content')

<style>
    body {
        background-color: #f4f7f6;
        /* Latar belakang abu-abu terang */
        color: #333;
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
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $users->links() }}
    </div>
    </div>
</div>
@endsection