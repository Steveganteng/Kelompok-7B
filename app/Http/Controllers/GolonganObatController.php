<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganObatController extends Controller
{
    // Menampilkan daftar golongan obat
    public function index()
    {
        $golonganObat = Golongan::all(); // Ambil semua golongan
        return view('apoteker.golonganobat', compact('golonganObat'));
    }

    // Menampilkan form untuk membuat golongan obat baru
    public function create()
    {
        return view('apoteker.create'); // Sesuaikan dengan file blade form create
    }

    // Menyimpan golongan obat baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'NamaGolongan' => 'required|string|max:255',
        ]);

        // Simpan golongan baru
        Golongan::create([
            'NamaGolongan' => $request->NamaGolongan,
        ]);

        return redirect()->route('golongan_obat.index')->with('success', 'Golongan obat berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $golonganObat = Golongan::findOrFail($id);
        return view('apoteker.golonganobat.edit', compact('golonganObat'));
    }

    // Update data golongan
    public function update(Request $request, $id)
    {
        $request->validate([
            'NamaGolongan' => 'required|string|max:255',
        ]);

        $golonganObat = Golongan::findOrFail($id);
        $golonganObat->NamaGolongan = $request->NamaGolongan;
        $golonganObat->save();

        return redirect()->route('golongan_obat.index')->with('success', 'Golongan obat berhasil diperbarui');
    }

    // Menghapus data golongan
    public function destroy($id)
    {
        $golonganObat = Golongan::findOrFail($id);
        $golonganObat->delete();

        return redirect()->route('golongan_obat.index')->with('success', 'Golongan obat berhasil dihapus');
    }
}
