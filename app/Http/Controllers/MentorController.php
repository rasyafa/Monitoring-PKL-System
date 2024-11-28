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
        $mentor = Auth::user(); // Mentor yang sedang login
        $users = $mentor->students()->paginate(5); // Mengambil siswa yang di-assign ke mentor ini
        return view('mentor.beranda', compact('users'));
    }

    public function dataSiswa()
    {
        $mentor = Auth::user();
        $users = $mentor->students()->paginate(5); // Mengambil data siswa yang relevan
        return view('mentor.datasiswa', compact('users'));
    }

    public function absenIndex()
    {
        $mentor = Auth::user();
        $absens = Absen::whereIn('user_id', $mentor->students()->pluck('id'))
            ->with('user')
            ->get();

        return view('mentor.absen', compact('absens'));
    }

    public function kegiatanIndex()
    {
        $mentor = Auth::user();
        $students = $mentor->students; // Mengambil siswa yang di-assign
        return view('mentor.kegiatan', compact('students'));
    }

    public function kegiatanShow($id)
    {
        $mentor = Auth::user();

        // Validasi siswa terkait dengan mentor yang login
        $student = $mentor->students()->findOrFail($id);

        $kegiatans = KegiatanHarian::where('user_id', $id)->get();

        return view('mentor.detail', compact('student', 'kegiatans'));
    }

    public function updateCatatan(Request $request, $id)
    {
        $mentor = Auth::user();

        // Validasi kegiatan milik siswa yang di-assign ke mentor
        $kegiatans = KegiatanHarian::where('id', $id)
            ->whereIn('user_id', $mentor->students()->pluck('id'))
            ->firstOrFail();

        $kegiatans->catatan = $request->catatan;
        $kegiatans->status = 'revisi'; // Tetapkan status sebagai revisi
        $kegiatans->save();

        return redirect()->back()->with('success', 'Catatan berhasil diperbarui!');
    }

    public function updateStatus(Request $request, $id)
    {
        $mentor = Auth::user();

        // Validasi kegiatan milik siswa yang di-assign ke mentor
        $kegiatans = KegiatanHarian::where('id', $id)
            ->whereIn('user_id', $mentor->students()->pluck('id'))
            ->firstOrFail();

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

    public function update(Request $request)
    {
        $mentor = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:8|confirmed',
            'city' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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
    $mentor = Auth::user();

    // Ambil daftar siswa yang di-assign ke mentor
    $students = $mentor->students;

    // Ambil laporan akhir siswa terkait
    $laporans = LaporanAkhir::whereIn('user_id', $students->pluck('id'))
        ->orderBy('created_at', 'desc')
        ->get();

    // Kirim data ke view
    return view('mentor.laporan', compact('students', 'laporans'));
}


    public function laporanAkhirShow($id)
{
    $mentor = Auth::user();

    // Pastikan siswa terkait dengan mentor
    $students = User::where('mentor_id', $mentor->id)->where('id', $id)->firstOrFail();

    // Ambil laporan akhir siswa terkait
    $laporans = LaporanAkhir::where('user_id', $id)->get();

    // Kirim data ke view
    return view('mentor.laporan_akhir', compact('students', 'laporans'));
}

}