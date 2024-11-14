<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\KegiatanHarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:admin'); // Disesuaikan dengan nama di Kernel.php
    // }

    public function dashboard()
    {
        $data = [
            'message' => 'Selamat datang, Admin!',
            'users_count' => User::count(),
            'students_count' => User::where('role', 'siswa')->count(),
            'pembimbing_count' => User::where('role', 'pembimbing')->count(),
            'partners_count' => User::where('role', 'mitra')->count(),
            'mentors_count' => User::where('role', 'mentor')->count(),
        ];

        return view('admin.dashboard', compact('data'));
    }

    // Tampilkan daftar pengguna
    public function manageUsers()
    {
        $users = User::whereIn('role', ['siswa', 'pembimbing', 'mentor', 'mitra'])->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Tampilkan form untuk membuat pengguna baru
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Simpan pengguna baru
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:siswa,pembimbing,mentor,mitra',
            'gender' => 'required|in:male,female',
            'city' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'gender' => $request->gender,
            'city' => $request->city,
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan');
    }

    // Tampilkan form untuk mengedit pengguna
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update data pengguna
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:siswa,pembimbing,mentor,mitra',
            'gender' => 'required|in:male,female',
            'city' => 'required|string|max:255',
        ]);

        $data = $request->only('name', 'username', 'email', 'role', 'gender', 'city');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui');
    }

    // Hapus pengguna
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus');
    }

    // CRUD ABSEN SISWA

    // Menampilkan daftar absensi seluruh siswa
    public function manageAbsensi()
    {
        // Mengambil data absensi dengan paginasi (10 data per halaman)
        $absensis = Absen::paginate(5);

        // Mengirim data absensi ke view 'admin.absensi.index'
        return view('admin.absensi.index', compact('absensis'));
    }

    // Menampilkan form untuk menambahkan absensi baru
    public function createAbsensi()
    {
        // Mengambil data siswa untuk dipilih dalam absensi baru
        $students = User::where('role', 'siswa')->get();

        // Mengirim data siswa ke view 'admin.absensi.create'
        return view('admin.absensi.create', compact('students'));
    }

    // Menyimpan data absensi baru ke database
    public function storeAbsensi(Request $request)
    {
        // Validasi input dari form absensi
        $request->validate([
            'user_id' => 'required|exists:users,id', // Pastikan user_id ada di tabel users
            'tanggal' => 'required|date',            // Tanggal harus dalam format yang valid
            'status' => 'required|in:Hadir,Sakit,Izin,Alpha', // Status harus salah satu dari empat nilai ini
        ]);

        // Menyimpan data absensi baru ke database
        Absen::create($request->all());

        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('admin.absensi')->with('success', 'Data absensi berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit data absensi
    public function editAbsensi(Absen $absensi)
    {
        // Mengambil data siswa untuk dipilih dalam absensi
        $students = User::where('role', 'siswa')->get();

        // Mengirim data absensi dan siswa ke view 'admin.absensi.edit'
        return view('admin.absensi.edit', compact('absensi', 'students'));
    }

    // Memperbarui data absensi di database
    public function updateAbsensi(Request $request, Absen $absensi)
    {
        // Validasi input dari form edit absensi
        $request->validate([
            'user_id' => 'required|exists:users,id', // Pastikan user_id ada di tabel users
            'tanggal' => 'required|date',            // Tanggal harus dalam format yang valid
            'status' => 'required|in:Hadir,Sakit,Izin,Alpha', // Status harus salah satu dari empat nilai ini
        ]);

        // Mengupdate data absensi sesuai dengan input dari form
        $absensi->update($request->all());

        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('admin.absensi')->with('success', 'Data absensi berhasil diperbarui');
    }

    // Menghapus data absensi dari database
    public function deleteAbsensi(Absen $absensi)
    {
        // Menghapus data absensi yang dipilih
        $absensi->delete();

        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('admin.absensi')->with('success', 'Data absensi berhasil dihapus');
    }

    // CRUD Log-Book
    // Menampilkan daftar kegiatan harian semua siswa
    public function manageKegiatan()
    {
        // Mengambil semua data kegiatan harian beserta informasi siswa
        $kegiatans = KegiatanHarian::with('user')->paginate(10);
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    // Menampilkan form untuk membuat kegiatan harian baru
    public function createKegiatan()
    {
        // Mengambil semua siswa untuk dipilih pada form
        $students = User::where('role', 'siswa')->get();
        return view('admin.kegiatan.create', compact('students'));
    }

    // Menyimpan kegiatan harian baru ke database
    public function storeKegiatan(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'kegiatan' => 'required|string',
        ]);

        KegiatanHarian::create([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'kegiatan' => $request->kegiatan,
        ]);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan harian berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit kegiatan harian
    public function editKegiatan($id)
    {
        // Ambil data kegiatan harian berdasarkan ID
        $kegiatan = KegiatanHarian::findOrFail($id);

        // Ambil data siswa untuk pilihan
        $students = User::where('role', 'siswa')->get();

        return view('admin.kegiatan.edit', compact('kegiatan', 'students'));
    }

    // Memperbarui data kegiatan harian yang ada
    public function updateKegiatan(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'kegiatan' => 'required|string',
        ]);

        $kegiatan = KegiatanHarian::findOrFail($id);
        $kegiatan->update([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'kegiatan' => $request->kegiatan,
        ]);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan harian berhasil diperbarui');
    }

    // Menghapus kegiatan harian dari database
    public function deleteKegiatan($id)
    {
        $kegiatan = KegiatanHarian::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan harian berhasil dihapus');
    }
}
