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
        $user = Auth::user();

        $students = User::where('role', 'siswa')
        ->where('mentor_id', $user->id) // Pastikan siswa memiliki pembimbing yang sesuai
            ->paginate(5);
        return view('mentor.beranda', compact('students'));
    }

    public function dataSiswa()
    {
        $user = Auth::user();

        $students = User::where('role', 'siswa')
            ->where('mentor_id', $user->id) // Pastikan siswa memiliki pembimbing yang sesuai
            ->paginate(5);
        return view('mentor.datasiswa', compact('students'));
    }

    public function absenIndex()
    {
        $absens = Absen::with('user')->get();
        return view('mentor.absen', compact('absens'));
    }

    public function kegiatanIndex()
    {
        $user = Auth::user();  // Pembimbing yang sedang login

        // Mengambil siswa yang di-assign ke pembimbing yang sedang login
        $students = User::where('role', 'siswa')
            ->where('mentor_id', $user->id)  // Filter siswa berdasarkan pembimbing
            ->get();

        return view('mentor.kegiatan', compact('students'));
    }

    public function kegiatanShow($id)
    {
        $user = Auth::user();

        $student = User::findOrFail($id); // Pastikan variabel 'student' digunakan di sini

        if ($student->mentor_id != $user->id) {
            return redirect()->route('mentor.beranda')->with('error', 'Akses ditolak!');
        }

        $kegiatans = KegiatanHarian::where('user_id', $id)->get();

        return view('mentor.detail', compact('student', 'kegiatans'));
    }

    public function updateCatatan(Request $request, $id)
    {
        // Validasi kegiatan milik siswa yang di-assign ke mentor
        $kegiatans = KegiatanHarian::findOrFail($id);

        $kegiatans->catatan = $request->catatan;
        $kegiatans->status = 'revisi'; // Tetapkan status sebagai revisi
        $kegiatans->save();

        return redirect()->back()->with('success', 'Catatan berhasil diperbarui!');
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi kegiatan milik siswa yang di-assign ke mentor
        $kegiatans = KegiatanHarian::findOrFail($id);

        $kegiatans->status = $request->status;
        $kegiatans->save();

        return redirect()->back()->with('success', 'Status kegiatan berhasil diperbarui!');
    }


    // PROFILE
    public function profil()
    {
        $mentor = Auth::user();
        return view('mentor.profil', compact('mentor'));
    }

    public function edit()
    {
        $mentor = Auth::user();
        return view('mentor.edit', compact('mentor'));
    }

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

        $mentor = User::findOrFail($id);

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
                Storage::disk('public')->delete($mentor->profile_photo);
            }

            // Simpan foto baru di storage public
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $mentor->profile_photo = $photoPath;
        }

        $mentor->save();

        // Redirect ke halaman profil dengan parameter id
        return redirect()->route('mentor.profil', ['id' => $mentor->id])->with('success', 'Profil berhasil diperbarui.');
    }

    // LAPORAN AKHIR
    public function laporanAkhirIndex()
    {
        $user = Auth::user();

        // Ambil siswa yang dibimbing oleh pembimbing
        $students = User::where('mentor_id', $user->id)->get();

        $laporans = LaporanAkhir::whereHas('user', function ($query) use ($user) {
            $query->where('mentor_id', $user->id); // Pastikan hanya laporan yang sesuai pembimbing yang diambil
        })->get();

        // Kirim data ke view
        return view('mentor.laporan', compact('students', 'laporans'));
    }

    public function laporanAkhirShow($id)
    {
        $user = Auth::user();

        // Pastikan siswa terkait dengan mentor
        $students = User::findOrFail($id);

        // Validasi jika siswa tersebut di-assign ke pembimbing yang sedang login
        if ($students->mentor_id != $user->id) {
            return redirect()->route('mentor.beranda')->with('error', 'Akses ditolak!');
        }

        // Mengambil laporan akhir untuk siswa tersebut
        $laporans = LaporanAkhir::where('user_id', $id)->get();

        // Kirim data ke view
        return view('mentor.laporan_akhir', compact('students', 'laporans'));
    }

}