<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;  // Perbaiki penggunaan Auth
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
    // Fungsi untuk melihat profil mentor
    public function profil($id)
    {
        $user = Auth::user();

        // Cek akses, hanya bisa lihat profil sendiri
        if ($user->role !== 'pembimbing' || $user->id != $id) {
            return redirect()->route('home')->with('error',
                'Akses ditolak! Anda hanya bisa melihat profil Anda sendiri.'
            );
        }

        // Ambil data mentor berdasarkan id
        $pembimbing = User::findOrFail($id);  // Ganti User dengan Mentor

        return view('pembimbing.profil', compact('pembimbing'));
    }

    // Fungsi untuk edit profil mentor
    public function editprofil($id)
    {
        $pembimbing = User::findOrFail($id);  // Ganti User dengan Mentor

        // Pastikan hanya mentor yang sedang login yang bisa mengedit profilnya
        if (Auth::id() !== $pembimbing->id) {
            return redirect()->route('home')->with('error',
                'Akses ditolak! Anda hanya bisa mengedit profil Anda sendiri.'
            );
        }

        return view('pembimbing.editprofil', compact('pembimbing'));
    }

    // Fungsi untuk update data profil mentor
    public function update1(Request $request, $id)
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
        $pembimbing = User::findOrFail($id);  // Ganti User dengan Mentor

        // Update data mentor
        $pembimbing->name = $request->input('name');
        $pembimbing->email = $request->input('email');
        $pembimbing->city = $request->input('city');

        if ($request->filled('password')) {
            $pembimbing->password = bcrypt($request->input('password'));
        }

        // Proses upload foto jika ada
        if ($request->hasFile('profile_photo')) {
            // Cek jika foto lama ada dan hapus
            if ($pembimbing->profile_photo) {
                Storage::delete($pembimbing->profile_photo); // Hapus foto lama
            }

            // Simpan foto baru
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $pembimbing->profile_photo = $photoPath; // Simpan path foto
        }

        // Simpan perubahan ke database
        $pembimbing->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('pembimbing.profil', $pembimbing->id)->with('success', 'Profil berhasil diperbarui.');
    }

    // Menampilkan kegiatan
    public function indexkegiatan()
    {
        $kegiatan = Kegiatan::paginate(3);
        return view('pembimbing.monitoring', compact('kegiatan'));
    }

    // Menampilkan form untuk menambah kegiatan
    public function create()
    {
        return view('pembimbing.create');
    }

    // Menyimpan kegiatan baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Proses penyimpanan data kegiatan
        $kegiatan = new Kegiatan();
        $kegiatan->tanggal = $request->tanggal;
        $kegiatan->kegiatan = $request->kegiatan;

        // Jika ada gambar, simpan gambar
        if ($request->hasFile('image')) {
            // Menyimpan gambar ke folder 'gambar' di storage
            $imagePath = $request->file('image')->store('gambar', 'public');
            // Menyimpan hanya nama file (basename) untuk disimpan di database
            $kegiatan->image = basename($imagePath);
        }

        // Simpan data kegiatan
        $kegiatan->save();

        // Redirect ke halaman monitoring setelah berhasil
        return redirect()->route('monitoring')->with('success', 'Kegiatan berhasil ditambahkan!');
    }


    // Method Edit untuk menampilkan form edit berdasarkan ID kegiatan
    public function edit($id)
    {
        // Menemukan kegiatan berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($id);

        return view('pembimbing.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // Cari kegiatan berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($id);

        // Update data kegiatan
        $kegiatan->tanggal = $request->tanggal;
        $kegiatan->kegiatan = $request->kegiatan;

        // Update gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($kegiatan->image) {
                // Menghapus file gambar lama dari storage
                Storage::delete('public/gambar/' . $kegiatan->image);
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/gambar', $imageName);
            $kegiatan->image = $imageName; // Simpan nama file gambar baru
        }

        // Simpan perubahan
        $kegiatan->save();

        // Redirect dengan pesan sukses
        return redirect()->route('monitoring')->with('success', 'Kegiatan berhasil diperbarui!');
    }


    public function absenIndex()
    {
        $absens = Absen::with('user')->get(); // Mengambil data absen beserta data siswa
        return view('pembimbing.absen', compact('absens'));
    }

    public function dataSiswa()
    {
        $users = User::whereIn('role', ['siswa'])->paginate(5);
        return view('pembimbing.datasiswa', compact('users'));
    }

    public function kegiatanIndex()
    {
        // Mendapatkan data siswa dengan role 'siswa'
        $students = User::where('role', 'siswa')->get(); // Mengambil data siswa dengan peran 'siswa'
        return view('pembimbing.laporanharian', compact('students'));
    }

    // Menampilkan detail kegiatan/logbook siswa berdasarkan ID
    public function kegiatanShow($id)
    {
        // Cari siswa berdasarkan ID
        $students = User::findOrFail($id);

        // Ambil data kegiatan siswa berdasarkan ID siswa
        $kegiatans = KegiatanHarian::where('user_id', $id)->get();

        // Kirim data ke view
        return view('pembimbing.show', compact('students', 'kegiatans'));
    }

    // LAPORAN AKHIR
    public function laporanAkhirIndex()
    {
        $students = User::where('role', 'siswa')->get();
        $laporans = LaporanAkhir::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('pembimbing.laporan', compact('students', 'laporans'));
    }

    public function laporanAkhirShow($id)
    {
        // Cari siswa berdasarkan ID
        $students = User::findOrFail($id);

        // Ambil data laporan akhir berdasarkan ID siswa
        $laporans = LaporanAkhir::where('user_id', $id)->get();

        // Kirim data ke view
        return view('pembimbing.laporanakhir', compact('students', 'laporans'));
    }

    public function updateCatatan(Request $request, $id)
    {


        $laporans = LaporanAkhir::findOrFail($id);

        $laporans->catatan = $request->catatan;
        $laporans->status = 'revisi'; // Tetapkan status sebagai revisi
        $laporans->save();

        return redirect()->back()->with('success', 'Catatan berhasil diperbarui!');
    }

    public function updateStatus(Request $request, $id)
    {


        $laporans = LaporanAkhir::findOrFail($id);

        $laporans->status = $request->status;
        $laporans->save();

        return redirect()->back()->with('success', 'Status kegiatan berhasil diperbarui!');
    }
}
