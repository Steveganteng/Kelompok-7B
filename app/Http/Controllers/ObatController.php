<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Golongan;
use App\Models\Penanda;
use App\Models\Lokasi;
use App\Models\Satuan;


class ObatController extends Controller
{
    /**
     * Tampilkan form tambah obat.
     */
    public function create()
    {
        return view('apoteker.tambah_dataobat', [
            'golongans' => Golongan::all(),
            'penandas'  => Penanda::all(),
            'satuans'   => Satuan::all(),
            'lokasis'   => Lokasi::all(),
        ]);
    }

    /**
     * Simpan data obat ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'NamaObat'     => 'required|string|max:255',
            'isi_kemasan'  => 'required|string',
            'bobot_isi'    => 'required|string',
            'harga'        => 'required|numeric',
            'stok'         => 'required|numeric',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'golongan_id'  => 'required|exists:golongan,id_golongan',
            'penanda_id'   => 'required|exists:penanda,id_penanda',
            'satuan_id'    => 'required|exists:satuan,id_satuan',
            'area'         => 'required|string|max:255',
            'rak'          => 'required|string|max:100',
            'baris'        => 'required|integer',
            'kolom'        => 'required|integer',
            'deskripsi'    => 'nullable|string|max:255',
        ]);

        // Simpan atau ambil lokasi
        $lokasi = Lokasi::firstOrCreate([
            'area' => $request->area,
            'rak' => $request->rak,
            'baris' => $request->baris,
            'kolom' => $request->kolom,
        ], [
            'deskripsi' => $request->deskripsi,
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar-obat', 'public');
        }

        // Simpan data obat
        Obat::create([
            'NamaObat'    => $validated['NamaObat'],
            'stok'        => $validated['stok'],
            'harga'       => $validated['harga'],
            'deskripsi'   => "{$validated['isi_kemasan']} / {$validated['bobot_isi']}",
            'gambar'      => $validated['gambar'] ?? 'gambar-obat/default.png',
            'golongan_id' => $validated['golongan_id'],
            'penanda_id'  => $validated['penanda_id'],
            'satuan_id'   => $validated['satuan_id'],
            'lokasi_id'   => $lokasi->id_lokasi,
        ]);

        return redirect()->route('dataobat')->with('success', 'Data obat berhasil disimpan.');
    }
    public function edit($id)
    {
        $obat = Obat::with(['golongan', 'penanda', 'lokasi', 'satuan'])->findOrFail($id);

        $areaOptions = Lokasi::select('area')->distinct()->orderBy('area')->pluck('area');
        $rakOptions = Lokasi::select('rak')->distinct()->orderBy('rak')->pluck('rak');
        $barisOptions = Lokasi::select('baris')->distinct()->orderBy('baris')->pluck('baris');
        $kolomOptions = Lokasi::select('kolom')->distinct()->orderBy('kolom')->pluck('kolom');

        return view('apoteker.edit_dataobat', [
            'obat' => $obat,
            'golongans' => Golongan::all(),
            'penandas' => Penanda::all(),
            'satuans' => Satuan::all(),
            'areaOptions' => $areaOptions,
            'rakOptions' => $rakOptions,
            'barisOptions' => $barisOptions,
            'kolomOptions' => $kolomOptions,
        ]);
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'NamaObat'     => 'required|string|max:255',
            'isi_kemasan'  => 'required|string',
            'bobot_isi'    => 'required|string',
            'harga'        => 'required|numeric',
            'stok'         => 'required|numeric',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'area'         => 'required|string|max:255',
            'rak'          => 'required|string|max:100',
            'baris'        => 'required|integer',
            'kolom'        => 'required|integer',
            'deskripsi'    => 'nullable|string|max:255',
        ]);

        $obat = Obat::findOrFail($id);

        // Update atau buat lokasi
        $lokasi = Lokasi::firstOrCreate([
            'area' => $request->area,
            'rak' => $request->rak,
            'baris' => $request->baris,
            'kolom' => $request->kolom,
        ], [
            'deskripsi' => $request->deskripsi,
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar-obat', 'public');
            $obat->gambar = $gambarPath;
        }

        // Update data obat
        $obat->update([
            'NamaObat'  => $validated['NamaObat'],
            'stok'      => $validated['stok'],
            'harga'     => $validated['harga'],
            'deskripsi' => "{$validated['isi_kemasan']} / {$validated['bobot_isi']}",
            'lokasi_id' => $lokasi->id_lokasi,
        ]);

        $obat->save();

        return redirect()->route('dataobat')->with('success', 'Data obat berhasil diperbarui.');
    }

    /**
     * Tampilkan semua obat (untuk daftar).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $obats = Obat::with(['golongan', 'penanda', 'lokasi', 'satuan'])
            ->when($search, function ($query, $search) {
                return $query->where('NamaObat', 'like', '%' . $search . '%');
            })
            ->paginate(10)
            ->withQueryString(); // supaya parameter search tetap ada saat berpindah halaman

        return view('apoteker.dataobat', compact('obats', 'search'));
    }
}
