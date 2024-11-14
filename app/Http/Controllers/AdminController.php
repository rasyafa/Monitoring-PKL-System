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
            'username' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:siswa,pembimbing,mitra,mentor,admin',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|string',
            'city' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email' => $request->email,
            'gender' => $request->gender,
            'city' => $request->city,
        ]);
        // @dd($request->all());
        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
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

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui');
    }

    // Hapus pengguna
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }

    // CRUD ABSEN SISWA
    // Menampilkan daftar absen semua siswa
    public function absenIndex()
    {
        $absens = Absen::with('user')->get(); // Mengambil data absen beserta data siswa
        return view('admin.absen.index', compact('absens'));
    }

    // Menampilkan form untuk membuat absen baru
    public function absenCreate()
    {
        $students = User::where('role', 'siswa')->get(); // Mengambil data siswa saja
        return view('admin.absen.create', compact('students'));
    }

    // Menyimpan data absen yang baru
    public function absenStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'status' => 'required|string',
        ]);

        // Cek apakah data absen untuk user dan tanggal yang sama sudah ada
        $existingAbsen = Absen::where('user_id', $request->user_id)
            ->where('tanggal', $request->tanggal)
            ->first();

        if ($existingAbsen) {
            return redirect()->back()->withErrors(['error' => 'Siswa sudah absen pada tanggal ini.']);
        }

        Absen::create([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.absen.index')->with('success', 'Data absen berhasil disimpan.');
    }

    // Menampilkan form edit untuk absen tertentu
    public function absenEdit($id)
    {
        $absen = Absen::findOrFail($id);
        $students = User::where('role', 'siswa')->get();
        return view('admin.absen.edit', compact('absen', 'students'));
    }

    // Mengupdate data absen yang sudah ada
    public function absenUpdate(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'status' => 'required|string',
        ]);

        $absen = Absen::findOrFail($id);
        $absen->update([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.absen.index')->with('success', 'Data absen berhasil diperbarui.');
    }

    // Menghapus data absen
    public function absenDelete($id)
    {
        $absen = Absen::findOrFail($id);
        $absen->delete();

        return redirect()->route('admin.absen.index')->with('success', 'Data absen berhasil dihapus.');
    }

    // Menampilkan daftar kegiatan semua siswa
    public function kegiatanIndex()
    {
        $kegiatans = KegiatanHarian::with('user')->get(); // Mengambil data kegiatan beserta data siswa
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    // Menampilkan form untuk membuat kegiatan baru
    public function kegiatanCreate()
    {
        $students = User::where('role', 'siswa')->get(); // Mengambil data siswa saja
        return view('admin.kegiatan.create', compact('siswa'));
    }

    // Menyimpan data kegiatan baru
    public function kegiatanStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
            'kegiatan' => 'required|string',
        ]);

        KegiatanHarian::create([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'kegiatan' => $request->kegiatan,
        ]);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Data kegiatan berhasil disimpan.');
    }

    // Menampilkan form edit untuk kegiatan tertentu
    public function kegiatanEdit($id)
    {
        $kegiatan = KegiatanHarian::findOrFail($id);
        $students = User::where('role', 'siswa')->get();
        return view('admin.kegiatan.edit', compact('kegiatan', 'siswa'));
    }

    // Mengupdate data kegiatan yang sudah ada
    public function kegiatanUpdate(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i',
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

        return redirect()->route('admin.kegiatan.index')->with('success', 'Data kegiatan berhasil diperbarui.');
    }

    // Menghapus data kegiatan
    public function kegiatanDelete($id)
    {
        $kegiatan = KegiatanHarian::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Data kegiatan berhasil dihapus.');
    }
}
