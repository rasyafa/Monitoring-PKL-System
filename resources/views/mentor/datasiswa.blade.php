@extends('layouts.mentor')

@section('title', 'Data Siswa')

@section('header', 'Data Siswa')

@section('content')
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
        {{-- {{ $users->links() }} --}}
    </div>
</div>
@endsection
