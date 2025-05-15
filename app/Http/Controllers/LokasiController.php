<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::all();
        return view('apoteker.lokasiobat', compact('lokasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required|string|max:255',
            'rak' => 'required|string|max:50',
            'baris' => 'required|integer',
            'kolom' => 'required|integer',
        ]);

        Lokasi::create($request->only(['area', 'rak', 'baris', 'kolom', 'deskripsi']));

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'area' => 'required|string|max:255',
            'rak' => 'required|string|max:50',
            'baris' => 'required|integer',
            'kolom' => 'required|integer',
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($request->only(['area', 'rak', 'baris', 'kolom', 'deskripsi']));

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil diperbarui.');
    }
}
