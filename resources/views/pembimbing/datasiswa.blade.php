@extends('layouts.app')

@section('title', 'Data Siswa')

@section('header', 'Data Siswa')

@section('content')
    <style>

            .btn-secondary-custom {
                background-color: #6c757d;
                border-color: #6c757d;
                color: white;
            }

            .btn-secondary-custom:hover {
                background-color: #5a6268;
                border-color: #5a6268;
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

    {{-- button kembali --}}
    <div class="btn-container">
            <a href="{{ route('pembimbing.home') }}" class="btn btn-secondary-custom">Kembali</a>
        </div>
    </div>
</div>
@endsection