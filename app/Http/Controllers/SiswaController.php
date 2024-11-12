<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absen;
use Illuminate\Http\Request;
use App\Models\KegiatanHarian;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{

    // Fungsi untuk menampilkan beranda siswa dengan data chart
    public function index()
    {
        // Query untuk menghitung jumlah siswa berdasarkan bulan
        $monthlyData = User::where('role', 'siswa')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Persiapkan data untuk chart
        $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // Array untuk menampung jumlah siswa per bulan (12 bulan)
        foreach ($monthlyData as $record) {
            $data[$record->month - 1] = $record->count; // Menyimpan jumlah siswa per bulan
        }

        // Mengirimkan data ke view
        return view('siswa.beranda', compact('data'));
    }

    // Fungsi untuk menampilkan riwayat absen siswa
    public function absenIndex()
    {
        // Ambil data absen siswa yang sedang login
        $absens = Absen::where('user_id', Auth::id())->get();
        return view('siswa.absen', compact('absens'));
    }

    // Fungsi untuk menyimpan absen siswa
    public function absenStore(Request $request)
    {
        $request->validate([
            'status' => 'required',

        ]);

        // Cek apakah siswa sudah absen hari ini
        $existingAbsen = Absen::where('user_id', Auth::id())
            ->where('tanggal', today())
            ->first();

        if ($existingAbsen) {
            return back()->withErrors(['error' => 'Anda sudah absen hari ini.']);
        }

        // Simpan data absen
        Absen::create([
            'user_id' => Auth::id(),
            'tanggal' => today(),
            'status' => $request->status,

        ]);

        return redirect()->route('siswa.absen')->with('success', 'Absen berhasil disimpan.');
    }

    public function kegiatan()
    {
        // Ambil semua kegiatan yang terkait dengan siswa yang sedang login
        $kegiatans = KegiatanHarian::where('user_id', Auth::id())->get();

        // Kirimkan data ke view
        return view('siswa.kegiatan', compact('kegiatans'));
    }


    // Metode untuk menampilkan form tambah kegiatan
    public function create()
    {
        return view('siswa.tambah');
    }

    // Metode untuk menyimpan kegiatan baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'kegiatan' => 'required|string',
        ]);

        KegiatanHarian::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'kegiatan' => $request->kegiatan,
        ]);

        return redirect()->route('siswa.riwayat-kegiatan')->with('success', 'Kegiatan berhasil disimpan.');
    }


}