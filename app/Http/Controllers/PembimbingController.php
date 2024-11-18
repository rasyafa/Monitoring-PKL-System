<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Absen;
use App\Models\KegiatanHarian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembimbingController extends Controller
{
    // Menampilkan halaman utama (home) pembimbing
    public function index()
    {
        $pembimbings = []; // Gantilah dengan data sebenarnya, jika ada
        
        return view('pembimbing.home');
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
            $imagePath = $request->file('image')->store('gambar', 'public');
            $kegiatan->image = basename($imagePath);
        }

        $kegiatan->save();

        // Redirect ke halaman monitoring setelah berhasil
        return redirect()->route('monitoring')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    // Edit function: mencari kegiatan berdasarkan tanggal
    public function edit(Request $request)
    {
        $tanggal = $request->input('tanggal'); // Mengambil tanggal dari query string
        $kegiatan = Kegiatan::where('tanggal', $tanggal)->firstOrFail(); // Menemukan kegiatan berdasarkan tanggal

        return view('pembimbing.edit', compact('kegiatan'));
    }

    // Update function: untuk memperbarui data kegiatan
    public function update(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|string|max:255',
            'kegiatan' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        ]);

        // Cari kegiatan berdasarkan tanggal
        $tanggal = $request->input('tanggal');
        $kegiatan = Kegiatan::where('tanggal', $tanggal)->firstOrFail();

        // Update data kegiatan
        $kegiatan->tanggal = $request->tanggal;
        $kegiatan->kegiatan = $request->kegiatan;

        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($kegiatan->image) {
                Storage::delete('public/gambar/' . $kegiatan->image);
            }

            // Menyimpan gambar baru
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/gambar', $imageName); // Simpan gambar ke folder public/gambar
            $kegiatan->image = $imageName; // Simpan nama gambar baru ke database
        }


        // Simpan perubahan
        $kegiatan->save();

        // Redirect ke halaman monitoring setelah berhasil
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
        return view('pembimbing.index', compact('students'));
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

}
