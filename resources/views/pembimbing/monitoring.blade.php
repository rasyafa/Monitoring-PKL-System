@extends('layouts.pembimbing')

@section('title', 'Data Kegiatan')

@section('header', 'Data Kegiatan')

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

        .container {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

         .btn-custom {
            background-color: #03d703;
            border-color: #03d703;
            color: white;
        }

        .btn-custom:hover {
            background-color: #028d02;
            border-color: #028d02;
        }

        h2,
        .table th,
        .table td {
            color: black;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .form-container {
            display: inline-block;
        }

        .form-container textarea {
            resize: none;
            width: 100%;
            height: 100px;
        }

        /* Styling untuk tombol agar posisinya di sebelah kanan */
        .btn-container {
            text-align: right;
            margin-bottom: 20px;
        }
        /* Style untuk pagination */
       .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-item.active .page-link {
            background-color: #17d033;
            border-color: #17d033;
            color: white;
        }

        .pagination .page-item .page-link {
            color: #17d033;
            border: 1px solid #17d033;
        }

        .pagination .page-item:hover .page-link {
            background-color: #169e28;
            border-color: #169e28;
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
            border-color: #ccc;
        }

        .pagination .page-item .page-link {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
    </style>


        <div class="btn-container">
    <a href="{{ route('pembimbing.create') }}" class="btn btn-custom me-2">Tambah Kegiatan</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kegiatan</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kegiatan as $data)
            <tr>
                <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                <td>
                    <textarea class="form-control" rows="4" disabled>{{ $data->kegiatan }}</textarea>
                </td>
                <td>
                    <img src="{{ asset('storage/gambar/' . $data->image) }}" width="200" alt="Image">
                </td>
                <td>
                    <a href="{{ route('pembimbing.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $kegiatan->links() }}
</div>

@endsection
