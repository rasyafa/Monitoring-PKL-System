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

        $users = User::whereIn('role', ['siswa'])->paginate(5);
        return view('mentor.beranda', compact('users'));
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

    public function updateCatatan(Request $request, $id)
    {
        $kegiatans = KegiatanHarian::findOrFail($id);

        $kegiatans->catatan = $request->catatan;
        $kegiatans->status = 'revisi'; // Tetapkan status sebagai revisi
        $kegiatans->save();

        return redirect()->back()->with('success', 'Catatan berhasil diperbarui!');
    }

    public function updateStatus(Request $request, $id)
    {
        $kegiatans = KegiatanHarian::findOrFail($id);

        $kegiatans->status = $request->status;
        $kegiatans->save();

        return redirect()->back()->with('success', 'Status kegiatan berhasil diperbarui!');
    }


    // PROFILE
    // Fungsi menampilkan profil mentor
    public function profil($id)
    {
        $user = Auth::user();

        // Cek akses, hanya mentor login dan ID sesuai
        if ($user->role !== 'mentor' || $user->id !== (int)$id) {
            return redirect()->route('home')->with('error', 'Akses ditolak! Anda hanya dapat melihat profil Anda sendiri.');
        }

        // Ambil data mentor berdasarkan ID
        $mentor = User::where('role', 'mentor')->findOrFail($id);

        return view('mentor.profil', compact('mentor'));
    }

    // Fungsi menampilkan halaman edit profil mentor
    public function edit($id)
    {
        $mentor = User::where('role', 'mentor')->findOrFail($id);

        // Pastikan hanya mentor yang login bisa mengedit profilnya
        if (Auth::id() !== $mentor->id) {
            return redirect()->route('home')->with('error', 'Akses ditolak! Anda hanya dapat mengedit profil Anda sendiri.');
        }

        return view('mentor.edit', compact('mentor'));
    }

    // Fungsi untuk update profil mentor
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:8|confirmed',
            'city' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari mentor berdasarkan ID
        $mentor = User::where('role', 'mentor')->findOrFail($id);

        // Pastikan hanya mentor login yang bisa mengedit data
        if (Auth::id() !== $mentor->id) {
            return redirect()->route('home')->with('error', 'Akses ditolak! Anda hanya dapat mengedit profil Anda sendiri.');
        }

        // Update data mentor
        $mentor->name = $request->input('name');
        $mentor->email = $request->input('email');
        $mentor->city = $request->input('city');

        if ($request->filled('password')) {
            $mentor->password = bcrypt($request->input('password'));
        }

        // Proses upload foto jika ada
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($mentor->profile_photo) {
                Storage::delete($mentor->profile_photo);
            }

            // Simpan foto baru
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $mentor->profile_photo = $photoPath;
        }

        // Simpan perubahan ke database
        $mentor->save();

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
