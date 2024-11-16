@extends('layouts.mentor')

@section('title', 'Dashboard Mentor')

@section('header', 'Beranda Mentor')

@section('content')
<div class="container-fluid px-4">
    <div class="row my-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Jumlah Siswa</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Siswa 1</td>
                                <td>Aktif</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Siswa 2</td>
                                <td>Aktif</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Siswa 3</td>
                                <td>Non-Aktif</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Siswa 4</td>
                                <td>Aktif</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
