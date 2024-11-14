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
}
