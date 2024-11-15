<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absen;
use Illuminate\Http\Request;
use App\Models\KegiatanHarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SiswaController extends Controller
{
// BERANDA
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
// AKHIR BERANDA

// PROFILE
    // Fungsi untuk melihat profil siswa
    public function show($id)
    {
        $user = Auth::user();

        // Cek akses, hanya bisa lihat profil sendiri
        if ($user->role !== 'siswa' || $user->id != $id) {
            return redirect()->route('home')->with('error', 'Akses ditolak! Anda hanya bisa melihat profil Anda sendiri.');
        }

        // Ambil data siswa berdasarkan id
        $siswa = User::findOrFail($id);

        return view('siswa.show', compact('siswa'));
    }

    // Fungsi untuk edit profil siswa
    public function edit($id)
    {
        $siswa = User::findOrFail($id);

        // Pastikan hanya siswa yang sedang login yang bisa mengedit profilnya
        if (
            Auth::id() !== $siswa->id
        ) {
            return redirect()->route('home')->with('error', 'Akses ditolak! Anda hanya bisa mengedit profil Anda sendiri.');
        }

        return view('siswa.edit', compact('siswa'));
    }

    // Fungsi untuk update data profil siswa
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'city' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Cari user berdasarkan ID
        $siswa = User::findOrFail($id);

        // Update data user
        $siswa->name = $request->input('name');
        $siswa->email = $request->input('email');
        $siswa->city = $request->input('city');

        // Proses upload foto jika ada
        if ($request->hasFile('profile_photo')) {
            // Cek jika foto lama ada dan hapus
            if ($siswa->profile_photo) {
                Storage::delete($siswa->profile_photo); // Hapus foto lama
            }

            // Simpan foto baru
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $siswa->profile_photo = $photoPath; // Simpan path foto
        }

        // Simpan perubahan ke database
        $siswa->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('siswa.show', $siswa->id)->with('success', 'Profil berhasil diperbarui.');
    }
// AKHIR PROFILE

// ABSEN
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

        // / Batas waktu absen
        $startTime = Carbon::createFromTime(7, 0, 0, 'Asia/Jakarta');
        $endTime = Carbon::createFromTime(14, 0, 0, 'Asia/Jakarta');
        $currentTime = Carbon::now('Asia/Jakarta');

        if ($currentTime->lt($startTime) || $currentTime->gt($endTime)) {
            return back()->withErrors(['error' => 'Absen hanya bisa dilakukan dari jam 07:00 hingga jam 14:00.']);
        }
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
// AKHIR ABSEN

//  KEGIATAN HARIAN
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
// AKHIR KEGIATAN HARIAN

}