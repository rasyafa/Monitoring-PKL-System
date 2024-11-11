<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absen;
use Illuminate\Http\Request;
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
}
