@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@section('content')
<div class="row mb-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h5 class="mb-0">Data Siswa</h5>
            </div>
            <div class="card-body">
                <div class="chart-container" style="width: 100%;">
                    <canvas id="chartSiswa" style="width: 100%; height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h5 class="mb-0">Data Pembimbing</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartPembimbing"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h5 class="mb-0">Data Mitra</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartMitra"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h5 class="mb-0">Data Mentor</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartMentor"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Include chart.js script dari HTML original, contoh pengisian chart
        const ctxSiswa = document.getElementById('chartSiswa').getContext('2d');
        new Chart(ctxSiswa, {
            type: 'line',
            data: {
                // Data chart siswa
            }
        });
</script>
@endpush
