@extends('layouts.admin')

@section('title', 'Manage Users')

@section('page-title', 'Manage Users')

@push('styles')
<style>
    .content-container {
        margin-left: 30px;
        /* Jarak dari sidebar */
    }

    .card {
        margin-bottom: 30px;
        /* Jarak antar card */
        border: none;
        /* Hilangkan border card */
        border-radius: 10px;
        /* Radius lebih besar */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        /* Shadow lebih besar */
    }

    .card-header {
        background-color: transparent;
        /* Hilangkan latar abu-abu */
        font-size: 1.5rem;
        /* Perbesar font */
        font-weight: bold;
        color: #333;
        /* Warna teks */
        padding: 20px;
        /* Tambah padding */
        border-bottom: none;
        /* Hilangkan garis bawah */
    }

    .card-body {
        padding: 30px;
        /* Tambah padding body */
        font-size: 1.1rem;
        /* Ukuran teks lebih besar */
    }

    .table-container {
        overflow-x: auto;
        /* Scroll horizontal jika tabel terlalu lebar */
    }

    .table {
        font-size: 1rem;
        /* Ukuran font tabel */
    }

    .btn {
        font-size: 1rem;
        /* Ukuran font tombol */
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        padding: 10px 20px;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-warning {
        padding: 8px 18px;
    }

    .btn-danger {
        padding: 8px 18px;
    }
</style>
@endpush

@section('content')
<div class="content-container">
    <div class="card">
        <div class="card-header">
            Manage Users
        </div>
        <div class="card-body">
            <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-4">Add New User</a>
            <div class="table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
