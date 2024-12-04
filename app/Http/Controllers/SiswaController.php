<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Absen;
use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use App\Models\KegiatanHarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
// BERANDA
    public function index()
    {
        // Ambil ID siswa yang sedang login
        $userId = Auth::id();
        $today = now()->toDateString();

        // Cek apakah siswa sudah absen hari ini
        $Absen = Absen::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->exists();

        // Cek apakah siswa sudah mengisi laporan kegiatan hari ini
        $IsiLaporan = KegiatanHarian::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->exists();

        // Kirim data ke view
        return view('siswa.beranda', compact('Absen', 'IsiLaporan'));
    }
// AKHIR BERANDA

// PROFILE
    // Fungsi untuk melihat profil siswa
    public function show($id)
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Cek akses, hanya bisa lihat profil sendiri
        if ($user->role !== 'siswa' || $user->id != $id) {
            return redirect()->route('welcome');
        }

        // Ambil data siswa berdasarkan id
        $siswa = User::findOrFail($id);

        return view('siswa.show', compact('siswa'));
    }

    // Fungsi untuk edit profil siswa
    public function edit($id)
    {
        // Mencari data siswa berdasarkan ID, jika tidak ditemukan akan menghasilkan error
        $siswa = User::findOrFail($id);

        // Pastikan hanya siswa yang sedang login yang bisa mengedit profilnya
        if (Auth::id() !== $siswa->id) {
            return redirect()->route('welcome');
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
            'password' => 'nullable|min:8|confirmed',
            'city' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Cari user berdasarkan ID
        $siswa = User::findOrFail($id);

        // Update data user
        $siswa->name = $request->input('name');
        $siswa->email = $request->input('email');
        $siswa->city = $request->input('city');

        // Jika password diisi, enkripsi password dan simpan
        if ($request->filled('password')) {
            $siswa->password = bcrypt($request->input('password'));
        }

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

        $siswa->save();

        // Redirect ke halaman profil
        return redirect()->route('siswa.show', $siswa->id);
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
            'foto' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        // / Batas waktu absen
        $startTime = Carbon::createFromTime(7, 0, 0, 'Asia/Jakarta');
        $endTime = Carbon::createFromTime(14, 0, 0, 'Asia/Jakarta');
        $currentTime = Carbon::now('Asia/Jakarta');

        // Jika waktu sekarang di luar jam absen, tampilkan pesan error
        if ($currentTime->lt($startTime) || $currentTime->gt($endTime)) {
            return back()->withErrors(['error' => 'Absen hanya bisa dilakukan dari jam 07:00 hingga jam 14:00.']);
        }

        // Cek apakah siswa sudah absen hari ini
        $existingAbsen = Absen::where('user_id', Auth::id())
            ->where('tanggal', today())
            ->first();

        // Jika sudah absen hari ini, tampilkan pesan error
        if ($existingAbsen) {
            return back()->withErrors(['error' => 'Anda sudah absen hari ini.']);
        }

        // Simpan foto ke dalam folder
        $fotoPath = $request->file('foto')->store('absen_fotos', 'public');

        // Simpan data absen
        Absen::create([
            'user_id' => Auth::id(),
            'tanggal' => today(),
            'status' => $request->status,
            'foto' => $fotoPath,
       ]);

        return redirect()->route('siswa.absen')->with('success', 'Absen berhasil disimpan.');
    }
// AKHIR ABSEN

//  KEGIATAN HARIAN
    public function kegiatan()
    {
        // Ambil semua kegiatan yang terkait dengan siswa yang sedang login
        $kegiatans = KegiatanHarian::where('user_id', Auth::id())->paginate(5);

        return view('siswa.kegiatan', compact('kegiatans'));
    }

    // menampilkan form tambah kegiatan
    public function create()
    {
        return view('siswa.tambah');
    }

    // menyimpan kegiatan baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'kegiatan' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        // Batas waktu pengisian kegiatan
        $startTime = Carbon::createFromTime(8, 0, 0, 'Asia/Jakarta'); // 08:00
        $endTime = Carbon::createFromTime(21, 0, 0, 'Asia/Jakarta'); // 16:00
        $currentTime = Carbon::now('Asia/Jakarta'); // Waktu saat ini

        if ($currentTime->lt($startTime) || $currentTime->gt($endTime)) {
            return back()->withErrors(['error' => 'Pengisian laporan harian hanya dapat dilakukan dari jam 08:00 hingga jam 16:00.']);
        }

        // Periksa apakah siswa sudah mengisi kegiatan untuk tanggal yang sama
        $existingKegiatan = KegiatanHarian::where('user_id', Auth::id())
        ->whereDate('tanggal', $request->tanggal)
        ->first();

        if ($existingKegiatan) {
            return back()->withErrors(['error' => 'Anda sudah mengisi laporan harian untuk tanggal ini.']);
        }

        // Menangani unggahan file jika ada file yang dikirimkan
        $filePath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Menyimpan file ke dalam folder 'kegiatan_fotos' di dalam direktori 'public/storage'
            $filePath = $file->store('kegiatan_fotos', 'public');
        }

        KegiatanHarian::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'kegiatan' => $request->kegiatan,
            'foto' => $filePath,
        ]);

        return redirect()->route('siswa.riwayat-kegiatan')->with('success', 'Kegiatan berhasil disimpan.');
    }
// AKHIR KEGIATAN HARIAN

// AWAL LAPORAN AKHIR
    public function showRiwayatLaporan()
    {
        // Mengambil laporan akhir berdasarkan user yang sedang login, diurutkan berdasarkan tanggal terbaru
        $laporans = LaporanAkhir::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('siswa.laporan_akhir', compact('laporans'));
    }

    // Menyimpan laporan baru
    public function simpanLaporan(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx',
            'judul' => 'required|string|max:255',
            'link_laporan' => 'required|url',
        ]);

        // Mendapatkan nama file asli yang diupload oleh pengguna
        $originalFileName = $request->file('file')->getClientOriginalName();

        // Menyimpan file dengan nama asli ke folder 'laporan' di penyimpanan publik
        $filePath = $request->file('file')->storeAs('laporan', $originalFileName, 'public');

        LaporanAkhir::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'file_path' => $filePath,
            'link_laporan' => $request->link_laporan,
            'tanggal' => today(),
        ]);

        return redirect()->route('laporan.riwayat')->with('success', 'Laporan berhasil dikirim.');
    }

    // Menghapus laporan
    public function hapusLaporan($id)
    {
        // Mengambil laporan berdasarkan ID, menghapus file terkait, dan menghapus data laporan
        $laporan = LaporanAkhir::findOrFail($id);
        Storage::delete($laporan->file_path);
        $laporan->delete();

        return redirect()->route('laporan.riwayat')->with('success', 'Laporan berhasil dihapus.');
    }
// AKHIR LAPORAN

// NOTIFIKASI
    public function notifikasi()
    {
        $user = Auth::user();
        // Pastikan hanya siswa yang dapat mengakses notifikasi
        if ($user->role !== 'siswa') {
            return redirect()->route('welcome');
        }

        // Tanggal hari ini
        $tanggalHariIni = Carbon::today();

        // Cek apakah siswa sudah absen hari ini
        $absen = Absen::where('user_id',$user->id)
        ->where('tanggal', $tanggalHariIni)
        ->first();

        // Cek apakah siswa sudah mengisi laporan harian hari ini
        $laporanHarian = KegiatanHarian::where('user_id', $user->id)
        ->where('tanggal', $tanggalHariIni)
        ->get();

        return view('siswa.notifikasi', compact('user', 'absen', 'laporanHarian', 'tanggalHariIni'));
    }
//AKHIR NOTIFIKASI

//DATA MITRA
    public function showAssign()
    {
        // Ambil data siswa yang sedang login
        $siswa = Auth::user();

        // Ambil data mitra yang berelasi dengan siswa
        $mitra = $siswa->mitra;

        // Pastikan hanya siswa yang memiliki akses
        if ($siswa->role !== 'siswa') {
            return redirect()->route('welcome');
        }

        return view('siswa.profil-mitra', compact('siswa', 'mitra'));
    }
}