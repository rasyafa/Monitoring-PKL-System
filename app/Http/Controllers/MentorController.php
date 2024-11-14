<?php

namespace App\Http\Controllers;
use App\Http\Controllers\MentorController;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index()
    {
        // Data retrieval (if needed)
        $mentors = [];
        return view('mentor.beranda', compact('mentors'));
    }

    public function kegiatanSiswa()
    {
        $users = [
        ['nama' => 'Hilma Fitri Solehah', 'link' => '#link1'],
        ['nama' => 'Yehezkiel Frederick Ruru', 'link' => '#link2'],
        ['nama' => 'Hana Hanifah', 'link' => '#link3'],
    ];

        return view('mentor.kegiatan', compact('users')); // Mengirim data 'users' ke view
    }

    public function detailKegiatan($id)
    {
    // Anda bisa mengambil data berdasarkan ID atau bisa juga langsung mengirim data yang sesuai
    $kegiatan = [
        ['id' => 1, 'tanggal' => '2024-11-13', 'waktu_mulai' => '08:00', 'waktu_selesai' => '10:00', 'kegiatan' => 'Rapat Tim'],
        ['id' => 2, 'tanggal' => '2024-11-13', 'waktu_mulai' => '10:30', 'waktu_selesai' => '12:00', 'kegiatan' => 'Analisis Data'],
        ['id' => 3, 'tanggal' => '2024-11-13', 'waktu_mulai' => '13:00', 'waktu_selesai' => '15:00', 'kegiatan' => 'Penyusunan Laporan'],
    ];

    // Temukan kegiatan berdasarkan ID
    $kegiatanDetail = collect($kegiatan)->firstWhere('id', $id);

    if (!$kegiatanDetail) {
        abort(404);  // Jika ID tidak ditemukan
    }

    return view('mentor.detail', compact('kegiatanDetail'));
    }

    public function absenIndex()
    {
        $absens = Absen::with('user')->get(); // Mengambil data absen beserta data siswa
        return view('admin.absen.index', compact('absens'));
    }
}
