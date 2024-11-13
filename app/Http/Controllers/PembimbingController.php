<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembimbingController extends Controller
{
    // Menampilkan halaman utama (home) pembimbing
    public function index()
    {
        $pembimbings = []; // Gantilah dengan data sebenarnya, jika ada
        return view('pembimbing.home', compact('pembimbings'));
    }

    // Menampilkan kegiatan
    public function indexkegiatan()
    {
        $kegiatan = Kegiatan::all();
        return view('pembimbing.index', compact('kegiatan'));
    }

    // Menampilkan form untuk menambah kegiatan
    public function create()
    {
        return view('pembimbing.create');
    }

    // Menyimpan data kegiatan baru
    public function store(Request $request)
    {
        // Validasi form input
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Menggunakan nullable jika gambar opsional
        ]);

        // Membuat instansi model Kegiatan baru
        $kegiatan = new Kegiatan();
        $kegiatan->tanggal = $request->tanggal;
        $kegiatan->kegiatan = $request->kegiatan;

        // Mengecek apakah ada gambar yang di-upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('gambar', 'public'); // Menyimpan gambar di storage/app/public/gambar

            // Simpan nama file gambar ke database (menggunakan basename untuk hanya menyimpan nama file)
            $kegiatan->image = basename($imagePath);
        }

        $kegiatan->save();

        // Redirect dengan pesan sukses
        return redirect()->route('pembimbing.create')->with('success', 'Kegiatan berhasil ditambahkan!');
    }
}
