<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\KegiatanHarian;
use App\Models\User;
use App\Models\LaporanAkhir;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MentorController extends Controller
{
    public function index()
    {
        // Data retrieval (if needed)
        $mentors = [];
        return view('mentor.beranda', compact('mentors'));
    }

    public function dataSiswa()
    {
        $users = User::whereIn('role', ['siswa'])->paginate(5);
        return view('mentor.datasiswa', compact('users'));
    }

    public function absenIndex()
    {
        $absens = Absen::with('user')->get(); // Mengambil data absen beserta data siswa
        return view('mentor.absen', compact('absens'));
    }

    public function kegiatanIndex()
    {
        $students = User::where('role', 'siswa')->get(); // Mengambil data siswa dengan peran 'siswa'
        return view('mentor.kegiatan', compact('students'));
    }

    public function kegiatanShow($id)
    {
        $students = User::findOrFail($id);

        $kegiatans = KegiatanHarian::where('user_id', $id)->get();

        return view('mentor.detail', compact('students', 'kegiatans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $kegiatan = KegiatanHarian::findOrFail($id);
        $request->validate([
            'status' => 'required|in:acc,revisi',
        ]);

        $kegiatan->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    // Update catatan
    public function updateCatatan(Request $request, $id)
    {
        $kegiatan = KegiatanHarian::findOrFail($id);
        $kegiatan->update(['catatan' => $request->catatan]);
        return redirect()->back()->with('success', 'Catatan berhasil diperbarui.');
    }

    // PROFILE
// Fungsi untuk melihat profil mentor
public function profil($id)
{
    $user = Auth::user();

    // Cek akses, hanya bisa lihat profil sendiri
    if ($user->role !== 'mentor' || $user->id != $id) {
        return redirect()->route('home')->with('error', 'Akses ditolak! Anda hanya bisa melihat profil Anda sendiri.');
    }

    // Ambil data mentor berdasarkan id
    $mentor = User::findOrFail($id);  // Ganti User dengan Mentor

    return view('mentor.profil', compact('mentor'));
}

// Fungsi untuk edit profil mentor
public function edit($id)
{
    $mentor = User::findOrFail($id);  // Ganti User dengan Mentor

    // Pastikan hanya mentor yang sedang login yang bisa mengedit profilnya
    if (Auth::id() !== $mentor->id) {
        return redirect()->route('home')->with('error', 'Akses ditolak! Anda hanya bisa mengedit profil Anda sendiri.');
    }

    return view('mentor.edit', compact('mentor'));
}

// Fungsi untuk update data profil mentor
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:8|confirmed',
            'city' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Cari mentor berdasarkan ID
        $mentor = User::findOrFail($id);  // Ganti User dengan Mentor

        // Update data mentor
        $mentor->name = $request->input('name');
        $mentor->email = $request->input('email');
        $mentor->city = $request->input('city');

        if ($request->filled('password')) {
            $mentor->password = bcrypt($request->input('password'));
        }

        // Proses upload foto jika ada
        if ($request->hasFile('profile_photo')) {
            // Cek jika foto lama ada dan hapus
            if ($mentor->profile_photo) {
                Storage::delete($mentor->profile_photo); // Hapus foto lama
            }

            // Simpan foto baru
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $mentor->profile_photo = $photoPath; // Simpan path foto
        }

        // Simpan perubahan ke database
        $mentor->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('mentor.profil', $mentor->id)->with('success', 'Profil berhasil diperbarui.');
    }

// LAPORAN AKHIR
    public function laporanAkhirIndex()
    {
        $students = User::where('role', 'siswa')->get();
        $laporans = LaporanAkhir::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('mentor.laporan', compact('students', 'laporans'));
    }

    public function laporanAkhirShow($id)
    {
        // Cari siswa berdasarkan ID
        $students = User::findOrFail($id);

        // Ambil data laporan akhir berdasarkan ID siswa
        $laporans = LaporanAkhir::where('user_id', $id)->get();

        // Kirim data ke view
        return view('mentor.laporan_akhir', compact('students', 'laporans'));
    }



    // public function kegiatanSiswa()
    // {
    //     $users = [
    //     ['nama' => 'Hilma Fitri Solehah', 'link' => '#link1'],
    //     ['nama' => 'Yehezkiel Frederick Ruru', 'link' => '#link2'],
    //     ['nama' => 'Hana Hanifah', 'link' => '#link3'],
    // ];

    //     return view('mentor.kegiatan', compact('users')); // Mengirim data 'users' ke view
    // }

    // public function detailKegiatan($id)
    // {
    // // Anda bisa mengambil data berdasarkan ID atau bisa juga langsung mengirim data yang sesuai
    // $kegiatan = [
    //     ['id' => 1, 'tanggal' => '2024-11-13', 'waktu_mulai' => '08:00', 'waktu_selesai' => '10:00', 'kegiatan' => 'Rapat Tim'],
    //     ['id' => 2, 'tanggal' => '2024-11-13', 'waktu_mulai' => '10:30', 'waktu_selesai' => '12:00', 'kegiatan' => 'Analisis Data'],
    //     ['id' => 3, 'tanggal' => '2024-11-13', 'waktu_mulai' => '13:00', 'waktu_selesai' => '15:00', 'kegiatan' => 'Penyusunan Laporan'],
    // ];

    // // Temukan kegiatan berdasarkan ID
    // $kegiatanDetail = collect($kegiatan)->firstWhere('id', $id);

    // if (!$kegiatanDetail) {
    //     abort(404);  // Jika ID tidak ditemukan
    // }

    // return view('mentor.detail', ['kegiatanDetail' => (object) $kegiatanDetail]);
    // }

}
