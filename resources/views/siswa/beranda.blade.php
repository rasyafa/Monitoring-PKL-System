@extends('layouts.siswa') <!-- Menggunakan layout dengan nama 'siswa' yang telah didefinisikan -->

@section('content') <!-- Bagian ini adalah konten utama halaman yang akan di-render -->

  <!-- Menghubungkan file CSS dan JS dari FullCalendar -->
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' /> <!-- CSS untuk tampilan kalender -->
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script> <!-- JS untuk fungsionalitas kalender -->

  <!-- Container untuk Card (kotak) Notifikasi Absen dan Laporan Kegiatan -->
  <div class="container">
      <!-- Card Gabungan untuk Notifikasi Absen dan Laporan Kegiatan -->
      <div class="card mb-4" style="max-width: 900px; margin: 0 auto;">
          <div class="card-header">
              <h4>Notifikasi Terbaru Absen dan Laporan Harian</h4> <!-- Judul untuk card ini -->
          </div>
          <div class="card-body">
              <!-- Mengecek status absen dan laporan kegiatan -->
              @if(!$Absen && !$IsiLaporan)
                  <!-- Jika belum absen dan belum isi laporan -->
                  <div class="box-container mb-3">
                      <p><strong>Perhatian:</strong> Jangan lupa untuk melakukan absen sebelum jam 14:00!</p>
                  </div>
                  <hr> <!-- Pemisah antar box-container -->
                  <div class="box-container">
                      <p><strong>Segera isi laporan kegiatan Anda.</strong> Harap mengisi laporan harian setelah belajar hari ini.</p>
                  </div>
              @elseif(!$Absen)
                  <!-- Jika belum absen -->
                  <div class="box-container mb-3">
                      <p><strong>Perhatian:</strong> Jangan lupa untuk melakukan absen sebelum jam 14:00!</p>
                  </div>
              @elseif(!$IsiLaporan)
                  <!-- Jika belum isi laporan -->
                  <div class="box-container">
                      <p><strong>Segera isi laporan kegiatan Anda.</strong> Harap mengisi laporan harian setelah belajar hari ini.</p>
                  </div>
              @else
                  <!-- Jika sudah absen dan sudah isi laporan -->
                  <div class="box-container">
                      <p><strong>Semua tugas telah selesai.</strong> Terima kasih atas kedisiplinan Anda!</p>
                  </div>
              @endif
          </div>
      </div>
  </div>

  <!-- Container untuk Kalender -->
  <div id="calendar" class="calendar-container"></div> <!-- Tempat di mana kalender akan dirender -->

  <!-- Styling untuk kalender dan elemen lainnya -->
  <style>
      /* Styling untuk container kalender */
      .calendar-container {
          margin: 20px;
          padding: 20px;
          border-radius: 8px;
          background-color: #fff;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          width: 100%; /* Kalender akan mengikuti lebar kontainer */
          max-width: 900px; /* Lebar maksimal kalender agar sesuai dengan lebar kontainer */
          margin: 30px auto; /* Membuat kalender terpusat secara horizontal */
          overflow: hidden;
          position: relative; /* Memastikan kalender tetap di atas elemen lainnya */
          z-index: 10;
      }

      /* Mengatur tinggi kalender */
      #calendar {
          height: auto; /* Menyesuaikan tinggi kalender secara otomatis */
          min-height: 600px; /* Menetapkan tinggi minimal untuk kalender */
      }

      /* Mengatur tampilan angka tanggal pada kalender */
      .fc-daygrid-day-number {
          font-size: 12px; /* Ukuran font angka tanggal yang lebih kecil */
          padding: 5px; /* Memberikan sedikit jarak antara angka dan tepi kotak tanggal */
      }

      /* Mengatur jarak antar kolom dan baris pada kalender */
      .fc-daygrid-day {
          padding: 4px; /* Mengurangi padding antar kotak tanggal */
      }

      /* Memastikan teks dalam kotak tanggal berada di tengah */
      .fc-daygrid-day-top {
          text-align: center;
      }

      /* Styling untuk box-container yang menampilkan pesan */
      .box-container {
          border: 2px solid #ccc;
          padding: 15px;
          border-radius: 8px;
          margin-bottom: 15px;
          background-color: #f9f9f9; /* Warna latar belakang untuk box-container */
          z-index: 1;
      }

      /* Styling untuk garis pemisah antara konten */
      hr {
          margin: 20px 0;
          border: 0;
          border-top: 1px solid #ccc;
      }
  </style>

  <!-- Script untuk menginisialisasi dan menampilkan kalender -->
  <script>
      // Menunggu sampai konten halaman sepenuhnya dimuat sebelum menjalankan fungsi kalender
      document.addEventListener('DOMContentLoaded', function () {
          var calendarEl = document.getElementById('calendar'); // Mendapatkan elemen kalender
          var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth', // Menentukan tampilan kalender awal sebagai tampilan bulanan
              headerToolbar: {
                  left: 'prev,next', // Tombol navigasi untuk bulan sebelumnya dan berikutnya
                  center: 'title', // Menampilkan judul bulan di tengah
                  right: '' // Tidak menampilkan elemen di bagian kanan header
              },
              height: 'auto', // Tinggi kalender otomatis menyesuaikan kontainer
              events: [] // Masukkan data event kalender jika ada, saat ini kosong
          });
          calendar.render(); // Merender dan menampilkan kalender
      });
  </script>

@endsection

