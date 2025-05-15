<?php

namespace App\Http\Controllers;

use App\Models\ProdukKesehatan;
use App\Models\Satuan;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class ProdukKesehatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = ProdukKesehatan::with(['satuan', 'lokasi'])->orderBy('nama');

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        $produkKesehatan = $query->paginate(10)->appends(['search' => $search]);

        return view('apoteker.produkkesehatan', compact('produkKesehatan', 'search'));
    }

    public function create()
    {
        $satuans = Satuan::all();
        $lokasis = Lokasi::all();

        return view('apoteker.tambah_produkkesehatan', compact('satuans', 'lokasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'stok'      => 'required|integer',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'lokasi_id' => 'required|exists:lokasi,id_lokasi',
            'satuan_id' => 'required|exists:satuan,id_satuan',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar-produkkesehatan', 'public');
        } else {
            $validated['gambar'] = null;
        }

        ProdukKesehatan::create($validated);

        return redirect()->route('produkkesehatan.index')->with('success', 'Produk kesehatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = ProdukKesehatan::findOrFail($id);
        $satuans = Satuan::all();
        $lokasis = Lokasi::all();

        return view('apoteker.edit_produkkesehatan', compact('produk', 'satuans', 'lokasis'));
    }
    public function update(Request $request, $id)
{
    $produk = ProdukKesehatan::findOrFail($id);

    $validated = $request->validate([
        'nama'      => 'required|string|max:255',
        'stok'      => 'required|integer',
        'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'lokasi_id' => 'required|exists:lokasi,id_lokasi',
        'satuan_id' => 'required|exists:satuan,id_satuan',
    ]);

    // Upload gambar baru jika ada
    if ($request->hasFile('gambar')) {
        $validated['gambar'] = $request->file('gambar')->store('gambar-produkkesehatan', 'public');
    } else {
        $validated['gambar'] = $produk->gambar; // tetap gunakan gambar lama
    }

    $produk->update($validated);

    return redirect()->route('produkkesehatan.index')->with('success', 'Produk kesehatan berhasil diperbarui.');
}

}
