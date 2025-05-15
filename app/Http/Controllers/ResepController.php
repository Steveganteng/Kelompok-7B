<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Obat;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    public function showForm()
    {
        $obats = Obat::all();
        return view('dokter.tambah_resepobat', compact('obats'));
    }

    public function storeResep(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'pasien_id' => 'required|integer|exists:pasien,id_pasien',
            'obat' => 'required|array|min:1',
            'obat.*.nama' => 'required|string|max:255',
            'obat.*.jumlah' => 'required|integer|min:1',
            'obat.*.aturan' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $pasien_id = $request->input('pasien_id');
            $user_id = auth()->user()->id_user;

            $deskripsi = 'Resep untuk pasien: ' . $request->nama_pasien;

            foreach ($request->obat as $item) {
                $obatModel = Obat::where('NamaObat', $item['nama'])->first();

                if (!$obatModel) {
                    throw new \Exception("Obat dengan nama '{$item['nama']}' tidak ditemukan.");
                }

                Resep::create([
                    'tanggal' => now(),
                    'deskripsi' => $deskripsi,
                    'jenis_rawat' => 'Rawat Jalan',
                    'user_id' => $user_id,
                    'pasien_id' => $pasien_id,
                    'obat_id' => $obatModel->id_obat,
                    'jumlah' => $item['jumlah'],
                    'aturan_pakai' => $item['aturan'],
                    'dosis' => null, // Bisa dikembangkan jika ada input dosis
                ]);
            }

            DB::commit();

            return redirect()->route('resep.form')->with('success', 'Resep berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal menyimpan resep: ' . $e->getMessage())->withInput();
        }
    }
}
