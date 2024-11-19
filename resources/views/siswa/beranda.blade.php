@extends('layouts.siswa')

@section('content')
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>

  <!-- Container for Cards -->
  <div class="container">
      <!-- Combined Card for Absen Notification and Activity Report -->
      <div class="card mb-4" style="max-width: 900px; margin: 0 auto;">
          <div class="card-header">
              <h4>Notifikasi Absen dan Laporan Kegiatan</h4>
          </div>
          <div class="card-body">
              <!-- Absen Notification Section inside a box -->
              <div class="box-container mb-3">
                  <p><strong>Perhatian:</strong> Jangan lupa untuk melakukan absen sebelum jam 14:00!</p>
              </div>

              <!-- Divider between Absen and Laporan Kegiatan -->
              <hr>

              <!-- Laporan Kegiatan Section inside a box -->
              <div class="box-container">
                  <p><strong>Segera isi laporan kegiatan Anda.</strong>harap mengisi laporan harian setelah belajar hari ini.</p>
              </div>
          </div>
      </div>
  </div>

  <!-- Calendar Container -->
  <div id="calendar" class="calendar-container"></div>

  <style>
      /* Kalender container */
      .calendar-container {
          margin: 20px;
          padding: 20px;
          border-radius: 8px;
          background-color: #fff;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          width: 100%; /* Kalender mengikuti lebar kontainer 100% */
          max-width: 900px; /* Sesuaikan dengan lebar maksimal kotak notifikasi */
          margin: 30px auto;
          overflow: hidden;
          position: relative; /* Memastikan kalender berada di atas elemen lainnya */
          z-index: 10;
      }

      /* Mengatur tinggi kalender */
      #calendar {
          height: auto; /* Agar bisa menyesuaikan dengan ukuran kontainer */
          min-height: 600px; /* Menetapkan tinggi minimal untuk kalender */
      }

      /* Mengatur ukuran kotak tanggal */
      .fc-daygrid-day-number {
          font-size: 12px; /* Menurunkan ukuran font angka */
          padding: 5px; /* Menambahkan sedikit padding agar tidak terlalu rapat */
      }

      /* Menyesuaikan jarak antar kolom dan baris */
      .fc-daygrid-day {
          padding: 4px; /* Mengurangi padding antar kolom dan baris */
      }

      /* Memastikan text di dalam kotak tanggal rata tengah */
      .fc-daygrid-day-top {
          text-align: center;
      }

      /* Style for the box container */
      .box-container {
          border: 2px solid #ccc;
          padding: 15px;
          border-radius: 8px;
          margin-bottom: 15px;
          background-color: #f9f9f9;
          z-index: 1;
      }

      /* Style for the divider (line) */
      hr {
          margin: 20px 0;
          border: 0;
          border-top: 1px solid #ccc;
      }
  </style>

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
              events: [] // Masukkan data event kalender jika ada
          });
          calendar.render();
      });
  </script>

@endsection
