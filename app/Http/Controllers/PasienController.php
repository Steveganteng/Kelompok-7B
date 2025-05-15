<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    // Menampilkan form tambah rawat jalan
    public function showFormTambah()
    {
        return view('dokter.tambah_rawatjalan'); // Pastikan path view ini benar
    }

    // Proses simpan data pasien baru (rawat jalan)
    public function storeRawatJalan(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
        ]);

        Pasien::create([
            'nama_pasien' => $request->nama_pasien,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('rawatjalan.form')->with('success', 'Data pasien berhasil ditambahkan');
    }
}
