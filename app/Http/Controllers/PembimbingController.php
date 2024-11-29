<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Absen;
use App\Models\KegiatanHarian;
use App\Models\LaporanAkhir;
use Illuminate\Support\Facades\Storage;

class PembimbingController extends Controller
{
    // Menampilkan halaman utama (home) pembimbing
    public function index()
    {
        // Menghitung jumlah kegiatan harian
        $kegiatan = Kegiatan::count(); // Total data di tabel Kegiatan

        // Menghitung jumlah data absensi
        $absens = Absen::count(); // Total data di tabel Absen

        // Passing data ke view
        return view('pembimbing.home', compact('kegiatan', 'absens'));
    }

    // PROFILE
    public function profil($id)
    {
        $user = Auth::user();

        if ($user->role !== 'pembimbing' || $user->id != $id) {
            return redirect()->route('home')->with('error', 'Akses ditolak! Anda hanya bisa melihat profil Anda sendiri.');
        }

        $pembimbing = User::findOrFail($id);
        return view('pembimbing.profil', compact('pembimbing'));
    }

    public function editprofil($id)
    {
        $pembimbing = User::findOrFail($id);

        if (Auth::id() !== $pembimbing->id) {
            return redirect()->route('home')->with('error', 'Akses ditolak! Anda hanya bisa mengedit profil Anda sendiri.');
        }

        return view('pembimbing.editprofil', compact('pembimbing'));
    }

    public function update1(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:8|confirmed',
            'city' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $pembimbing = User::findOrFail($id);

        $pembimbing->name = $request->input('name');
        $pembimbing->email = $request->input('email');
        $pembimbing->city = $request->input('city');

        if ($request->filled('password')) {
            $pembimbing->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('profile_photo')) {
            if ($pembimbing->profile_photo) {
                Storage::delete($pembimbing->profile_photo);
            }

            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $pembimbing->profile_photo = $photoPath;
        }

        $pembimbing->save();

        return redirect()->route('pembimbing.profil', $pembimbing->id)->with('success', 'Profil berhasil diperbarui.');
    }

    public function indexkegiatan()
    {
        $kegiatan = Kegiatan::paginate(3);
        return view('pembimbing.monitoring', compact('kegiatan'));
    }

    public function create()
    {
        return view('pembimbing.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $kegiatan = new Kegiatan();
        $kegiatan->tanggal = $request->tanggal;
        $kegiatan->kegiatan = $request->kegiatan;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gambar', 'public');
            $kegiatan->image = $imagePath;
        }

        $kegiatan->save();

        return redirect()->route('monitoring')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('pembimbing.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->tanggal = $request->tanggal;
        $kegiatan->kegiatan = $request->kegiatan;

        if ($request->hasFile('image')) {
            if ($kegiatan->image) {
                Storage::disk('public')->delete($kegiatan->image);
            }

            $imagePath = $request->file('image')->store('gambar', 'public');
            $kegiatan->image = $imagePath;
        }

        $kegiatan->save();

        return redirect()->route('monitoring')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function absenIndex()
    {
        $absens = Absen::with('user')->get();
        return view('pembimbing.absen', compact('absens'));
    }

    // Menampilkan data siswa yang ditugaskan kepada pembimbing yang sedang login
    public function dataSiswa()
    {
        $user = Auth::user();

        $students = User::where('role', 'siswa')
                        ->where('pembimbing_id', $user->id) // Pastikan siswa memiliki pembimbing yang sesuai
                        ->paginate(5);

        return view('pembimbing.datasiswa', compact('students'));
    }

    public function kegiatanIndex()
    {
        $user = Auth::user();  // Pembimbing yang sedang login

        // Mengambil siswa yang di-assign ke pembimbing yang sedang login
        $students = User::where('role', 'siswa')
                        ->where('pembimbing_id', $user->id)  // Filter siswa berdasarkan pembimbing
                        ->get();

        return view('pembimbing.laporanharian', compact('students'));
    }


    // Menampilkan kegiatan harian siswa yang ditugaskan kepada pembimbing yang sedang login
    public function kegiatanShow($id)
    {
        $user = Auth::user();

        $student = User::findOrFail($id); // Pastikan variabel 'student' digunakan di sini

        if ($student->pembimbing_id != $user->id) {
            return redirect()->route('pembimbing.home')->with('error', 'Akses ditolak!');
        }

        $kegiatans = KegiatanHarian::where('user_id', $id)->get();

        return view('pembimbing.show', compact('student', 'kegiatans')); // Mengirimkan variabel 'student' dan 'kegiatans'
    }

    // Menampilkan laporan akhir untuk siswa yang ditugaskan kepada pembimbing
    public function laporanAkhirIndex()
{
    $user = Auth::user();

    // Ambil siswa yang dibimbing oleh pembimbing
    $students = User::where('pembimbing_id', $user->id)->get();

    $laporans = LaporanAkhir::whereHas('user', function ($query) use ($user) {
        $query->where('pembimbing_id', $user->id); // Pastikan hanya laporan yang sesuai pembimbing yang diambil
    })->get();

    return view('pembimbing.laporan', compact('laporans', 'students')); // Kirimkan data siswa dan laporan
}


    // Menampilkan laporan akhir untuk siswa berdasarkan ID
    public function laporanAkhirShow($id)
    {
        $user = Auth::user();  // Pembimbing yang sedang login

        $students = User::findOrFail($id);

        // Validasi jika siswa tersebut di-assign ke pembimbing yang sedang login
        if ($students->pembimbing_id != $user->id) {
            return redirect()->route('pembimbing.home')->with('error', 'Akses ditolak!');
        }

        // Mengambil laporan akhir untuk siswa tersebut
        $laporans = LaporanAkhir::where('user_id', $id)->get();

        return view('pembimbing.laporanakhir', compact('students', 'laporans'));
    }


    // Mengupdate catatan pada laporan akhir
    public function updateCatatan(Request $request, $id)
    {
        $laporans = LaporanAkhir::findOrFail($id);

        $laporans->catatan = $request->catatan;
        $laporans->status = 'revisi';
        $laporans->save();

        return redirect()->back()->with('success', 'Catatan berhasil diperbarui!');
    }

    // Mengupdate status laporan akhir
    public function updateStatus(Request $request, $id)
    {
        $laporans = LaporanAkhir::findOrFail($id);

        $laporans->status = $request->status;
        $laporans->save();

        return redirect()->back()->with('success', 'Status kegiatan berhasil diperbarui!');
    }
}
