<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
}
