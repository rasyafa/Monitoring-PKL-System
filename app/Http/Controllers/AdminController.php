<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\KegiatanHarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
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
    // Fungsi untuk menampilkan halaman absensi
    public function absenIndex()
    {
        // Mengambil data siswa yang berperan sebagai siswa
        $students = User::where('role', 'siswa')->get();

        // Mengambil semua data absensi dari tabel absens
        $attendances = Absen::all();

        // Tentukan tanggal awal dan akhir PKL
        $startDate = '2023-08-05';
        $endDate = '2023-12-05';

        // Dapatkan daftar hari kerja selama periode PKL
        $workingDays = $this->getWorkingDays($startDate, $endDate);

        // Hitung persentase kehadiran untuk setiap siswa
        foreach ($students as $student) {
            // Hitung total sesi berdasarkan hari kerja dalam periode
            $totalSessions = count($workingDays);
            $presentSessions = $attendances->where('user_id', $student->id)->where('status', 'Hadir')->count();

            // Persentase kehadiran berdasarkan status "Hadir"
            $student->attendance_percentage = $totalSessions > 0 ? ($presentSessions / $totalSessions) * 100 : 0;
            $student->total_sessions = $totalSessions;
            $student->present_sessions = $presentSessions;
        }

        // Kirim data ke view
        return view('admin.absen.index', compact('students', 'attendances'));
    }

    // Method privat untuk menghitung hari kerja
    private function getWorkingDays($startDate, $endDate)
    {
        // Mengubah tanggal awal dan akhir ke objek Carbon
        $start = Carbon::createFromFormat('Y-m-d', $startDate);
        $end = Carbon::createFromFormat('Y-m-d', $endDate);

        // Pastikan tanggal akhir lebih besar atau sama dengan tanggal awal
        if ($start->gt($end)) {
            return [];
        }

        $workingDays = [];

        // Iterasi setiap hari dari tanggal mulai hingga tanggal akhir
        while ($start->lte($end)) {
            // Cek apakah hari ini adalah Senin-Jumat (1=Senin, ..., 5=Jumat)
            if ($start->isWeekday()) {
                // Jika ya, tambahkan ke array hari kerja
                $workingDays[] = $start->toDateString();
            }
            // Tambahkan satu hari ke tanggal saat ini
            $start->addDay();
        }

        return $workingDays;
    }

    // Menampilkan daftar kegiatan semua siswa
    public function kegiatanIndex()
    {
        // Mendapatkan data siswa dengan role 'siswa'
        $students = User::where('role', 'siswa')->get(); // Mengambil data siswa dengan peran 'siswa'
        return view('admin.kegiatan.index', compact('students'));
    }



    // Menampilkan detail kegiatan/logbook siswa berdasarkan ID
    public function kegiatanShow($id)
    {
        // Cari siswa berdasarkan ID
        $students = User::findOrFail($id);

        // Ambil data kegiatan siswa berdasarkan ID siswa
        $kegiatans = KegiatanHarian::where('user_id', $id)->get();

        // Kirim data ke view
        return view('admin.kegiatan.show', compact('students', 'kegiatans'));
    }
}
