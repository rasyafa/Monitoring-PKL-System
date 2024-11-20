@extends('layouts.mentor')

@section('title', 'Dashboard Mentor')

@section('header', 'Beranda Mentor')

@section('content')
    <style>
        /* Layout untuk dashboard */
        .row.my-5 {
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            height: 100%;
            transition: margin-left 0.3s ease-out;
            max-width: 600px; /* Membatasi lebar card */
            margin: 0 auto;   /* Membuat card terpusat */
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Responsif */
        @media (max-width: 767px) {
            .row.my-5 {
                flex-direction: column;
            }

            /* Menyesuaikan card dengan lebar layar perangkat */
            .card {
                width: 100%;
            }
        }

        .calendar-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-header button {
            background: #25d366;
            /* Hijau WhatsApp */
            border: none;
            font-size: 1.25rem;
            color: white;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .calendar-header button:hover {
            background: #1c9c50;
            /* Hijau lebih gelap */
        }

        .calendar-header h2 {
            font-size: 1.25rem;
            margin: 0;
        }

        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-weight: bold;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .calendar-dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
        }

        .calendar-dates div {
            padding: 10px;
            margin: 2px;
            border-radius: 5px;
            /* Membuat bentuk kotak */
            transition: background 0.3s, color 0.3s;
            cursor: pointer;
        }

        .calendar-dates div:hover {
            background: #e9ecef;
        }

        .today {
            background: #25d366;
            /* Hijau WhatsApp */
            color: white;
        }
    </style>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="calendar-container">
        <div class="calendar-header">
            <button id="prevMonth">&lt;</button>
            <h2 id="monthYear"></h2>
            <button id="nextMonth">&gt;</button>
        </div>
        <div class="calendar-days">
            <div>Ming</div>
            <div>Sen</div>
            <div>Sel</div>
            <div>Rab</div>
            <div>Kam</div>
            <div>Jum</div>
            <div>Sab</div>
        </div>
        <div class="calendar-dates" id="calendarDates"></div>
    </div>

    <script>
        const monthYearEl = document.getElementById('monthYear');
        const calendarDatesEl = document.getElementById('calendarDates');
        const prevMonthBtn = document.getElementById('prevMonth');
        const nextMonthBtn = document.getElementById('nextMonth');

        const today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();

        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        function renderCalendar() {
            const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
            const lastDateOfMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

            monthYearEl.textContent = `${monthNames[currentMonth]} ${currentYear}`;
            calendarDatesEl.innerHTML = '';

            // Fill in previous month's blanks
            for (let i = 0; i < firstDayOfMonth; i++) {
                calendarDatesEl.innerHTML += '<div></div>';
            }

            // Fill in current month's dates
            for (let day = 1; day <= lastDateOfMonth; day++) {
                const dateDiv = document.createElement('div');
                dateDiv.textContent = day;

                // Highlight today
                if (
                    day === today.getDate() &&
                    currentMonth === today.getMonth() &&
                    currentYear === today.getFullYear()
                ) {
                    dateDiv.classList.add('today');
                }

                calendarDatesEl.appendChild(dateDiv);
            }
        }

        prevMonthBtn.addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        });

        nextMonthBtn.addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        });

        renderCalendar();
    </script>
@endsection
