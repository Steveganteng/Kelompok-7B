<?php

namespace App\Http\Controllers;

use App\Models\AlatKesehatan;
use App\Models\Golongan;
use App\Models\Penanda;
use App\Models\Lokasi;
use App\Models\Satuan;
use Illuminate\Http\Request;

class AlatKesehatanController extends Controller
{
    // Tampilkan daftar alat kesehatan
    public function index(Request $request)
{
    $search = $request->input('search');

    $query = AlatKesehatan::with(['golongan', 'penanda', 'lokasi', 'satuan'])
        ->orderBy('nama');

    if ($search) {
        $query->where('nama', 'like', '%' . $search . '%');
    }

    $alatKesehatans = $query->paginate(10)->appends(['search' => $search]);

    return view('apoteker.alatkesehatan', compact('alatKesehatans', 'search'));
}


    // Tampilkan form tambah alat kesehatan
    public function create()
    {
        $golongans = Golongan::all();
        $penandas = Penanda::all();
        $lokasis = Lokasi::all();
        $satuans = Satuan::all();

        return view('apoteker.tambah_alatkesehatan', compact('golongans', 'penandas', 'lokasis', 'satuans'));
    }

    // Simpan data alat kesehatan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'golongan_id' => 'required|exists:golongan,id_golongan',
            'penanda_id' => 'required|exists:penanda,id_penanda',
            'lokasi_id' => 'required|exists:lokasi,id_lokasi',
            'satuan_id' => 'required|exists:satuan,id_satuan',
            'harga' => 'required|integer',
            'status' => 'required|string|in:Tersedia,Dipakai,Sekali Pakai',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar-alatkesehatan', 'public');
        } else {
            $validated['gambar'] = null;
        }

        AlatKesehatan::create($validated);

        return redirect()->route('alatkesehatan.index')->with('success', 'Alat kesehatan berhasil ditambahkan.');
    }

    // Tampilkan form edit alat kesehatan berdasarkan ID
    public function edit($id)
    {
        $alat = AlatKesehatan::findOrFail($id);
        $golongans = Golongan::all();
        $penandas = Penanda::all();
        $lokasis = Lokasi::all();
        $satuans = Satuan::all();

        return view('apoteker.edit_alatkesehatan', compact('alat', 'golongans', 'penandas', 'lokasis', 'satuans'));
    }

    // Update data alat kesehatan berdasarkan ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'golongan_id' => 'required|exists:golongan,id_golongan',
            'penanda_id' => 'required|exists:penanda,id_penanda',
            'lokasi_id' => 'required|exists:lokasi,id_lokasi',
            'satuan_id' => 'required|exists:satuan,id_satuan',
            'harga' => 'required|integer',
            'status' => 'required|string|in:Tersedia,Dipakai,Sekali Pakai',
        ]);

        $alat = AlatKesehatan::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar-alatkesehatan', 'public');
            $alat->gambar = $gambarPath;
        }

        $alat->update($request->except('gambar'));

        return redirect()->route('alatkesehatan.index')->with('success', 'Data alat kesehatan berhasil diperbarui.');
    }

    // Update status alat kesehatan via modal atau form khusus
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Tersedia,Dipakai,Sekali Pakai',
        ]);

        $alat = AlatKesehatan::findOrFail($id);
        $alat->status = $request->status;
        $alat->save();

        return redirect()->back()->with('success', 'Status alat kesehatan berhasil diperbarui.');
    }
}
