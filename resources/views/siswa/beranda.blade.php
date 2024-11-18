@extends('layouts.siswa')

@section('content')
    <div class="container-fluid px-4">
        <div class="row my-5">
            <div class="col-lg-12 calendar-container">
                <div class="card">
                    <h3 class="card-title text-center">Kalender Kegiatan Siswa</h3>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: ''
                },
                height: 'auto',
                events: [

                    {
                        title: 'Kegiatan A',
                        start: '2024-11-10',
                        description: 'Deskripsi kegiatan A'
                    },
                    {
                        title: 'Kegiatan B',
                        start: '2024-11-12',
                        description: 'Deskripsi kegiatan B'
                    },
                ]
            });
            calendar.render();
        });
    </script>
@endsection
