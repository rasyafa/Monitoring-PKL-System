@extends('layouts.admin')

@section('title', 'Manage Users')

@section('page-title', 'Manajemen Pengguna')

@push('styles')
<style>
    /* Margin kiri untuk konten */
    .content-container {
        margin-left: 30px;
    }

    /* style untuk card */
    .card {
        margin-bottom: 30px;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    /* style untuk header card */
    .card-header {
        background-color: transparent;
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        padding: 20px;
        text-align: center;
        border-bottom: none;
    }

    /* style untuk header tabel */
    .table thead th {
        padding: 15px 20px;
        background-color: #32CD32;
        /* Hijau */
        color: #fff;
        text-align: center;
    }

    /* style untuk body card */
    .card-body {
        padding: 30px;
        font-size: 1.1rem;
    }

    /* style untuk container tabel */
    .table-container {
        overflow-x: auto;
    }

    /* style untuk tabel */
    .table {
        width: 100%;
        font-size: 1rem;
    }

    /* style untuk tombol */
    .btn {
        font-size: 1rem;
    }

    /* style untuk tombol hijau */
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        padding: 10px 20px;
    }

    /* style untuk tombol kuning edit */
    .btn-warning {
        padding: 8px 18px;
    }

    /* style untuk tombol merah delet */
    .btn-danger {
        padding: 8px 18px;
    }

    /* Pagination Custom */
    .pagination {
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-item .page-link {
        color: #32CD32;
        /* Warna hijau untuk teks */
        border: 1px solid #32CD32;
        margin: 0 2px;
    }

    .pagination .page-item.active .page-link {
        background-color: #32CD32;
        border-color: #32CD32;
        color: white;
    }

    .pagination .page-item .page-link:hover {
        background-color: #218838;
        border-color: #218838;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="content-container">
    <div class="card">
        <div class="card-header">
            Manajemen Pengguna
        </div>
        <div class="card-body">
            <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-4">Tambah Pengguna</a>
            <div class="table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Nama pengguna</th>
                            <th>Alamat surel</th>
                            <th>Peran</th>
                            <th>Aksi</th>
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
                                        onclick="return confirm('Are you sure?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
