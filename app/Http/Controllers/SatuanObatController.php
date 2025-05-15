<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanObatController extends Controller
{
    // Tampilkan semua data satuan (modal tambah & edit di halaman ini)
    public function index()
    {
        $satuan = Satuan::all();
        return view('apoteker.satuanobat', compact('satuan'));
    }

    // Simpan data baru dari modal tambah
    public function store(Request $request)
    {
        $request->validate([
            'nama_satuan' => 'required|string|max:100',
        ]);

        Satuan::create([
            'nama_satuan' => $request->nama_satuan,
        ]);

        return redirect()->route('satuan_obat.index')->with('success', 'Satuan berhasil ditambahkan.');
    }

    // Update data berdasarkan ID dari form edit (action='/satuanobat/{id}')
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_satuan' => 'required|string|max:100',
        ]);

        $satuan = Satuan::findOrFail($id); // id_satuan dikenali otomatis karena sudah di-set di model
        $satuan->update([
            'nama_satuan' => $request->nama_satuan,
        ]);

        return redirect()->route('satuan_obat.index')->with('success', 'Satuan berhasil diperbarui.');
    }
}
