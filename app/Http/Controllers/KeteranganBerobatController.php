<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\Resep;
use App\Models\Obat;
use App\Models\AlatKesehatan;

class keteranganberobatController extends Controller
{
    /**
     * Tampilkan daftar keterangan berobat
     */
    public function index()
    {
        $keteranganberobat = Pasien::with('pemeriksaan')->get();
        return view('dokter.keteranganberobat', compact('keteranganberobat'));
    }

    /**
     * Tampilkan form tambah keterangan berobat
     */
    public function create()
    {
        $obats = Obat::all();
        $alatKesehatan = AlatKesehatan::all();

        return view('dokter.tambah_keteranganberobat', compact('obats', 'alatKesehatan'));
    }

    /**
     * Proses penyimpanan data keterangan berobat
     */
    public function store(Request $request)
    {
        $v = $request->validate([
            // Data pasien
            'nama_pasien'       => 'required|string',
            'jenis_kelamin'     => 'required|string|in:Laki-laki,Perempuan',
            'tempat_lahir'      => 'required|string',
            'tanggal_lahir'     => 'required|date',
            'alamat'            => 'required|string',
            'telepon'           => 'required|string',

            // Pemeriksaan
            'mulai_diwawati'    => 'required|date_format:Y-m-d\TH:i',
            'anamnesis'         => 'nullable|string',
            'tinggi_badan'      => 'required|integer',
            'berat_badan'       => 'required|integer',
            'suhu_tubuh'        => 'required|numeric',
            'saturasi_oksigen'  => 'required|integer',
            'tekanan_darah_sistolik'    => 'required|integer',
            'tekanan_darah_diastolik'   => 'required|integer',
            'nadi'              => 'required|integer',
            'laju_pernapasan'   => 'required|integer',
            'pemeriksaan_penunjang' => 'nullable|string',
            'obat_dikonsumsi_sebelumnya' => 'nullable|string',
            'diagnosa'          => 'required|string',

            // Data tindakan & resep JSON (string)
            'tindakan_data'     => 'nullable|string',
            'resep_data'        => 'nullable|string',
        ]);

        DB::transaction(function () use ($v) {
            // Simpan pasien
            $pasien = Pasien::create([
                'nama_pasien'   => $v['nama_pasien'],
                'tanggal_lahir' => $v['tanggal_lahir'],
                'jenis_kelamin' => $v['jenis_kelamin'],
                'alamat'        => $v['alamat'],
                'telepon'       => $v['telepon'],
            ]);

            // Simpan pemeriksaan
            Pemeriksaan::create([
                'pasien_id'                 => $pasien->id_pasien,
                'mulai_diwawati'            => $v['mulai_diwawati'],
                'anamnesis'                 => $v['anamnesis'] ?? null,
                'tinggi_badan'              => $v['tinggi_badan'],
                'berat_badan'               => $v['berat_badan'],
                'suhu_tubuh'                => $v['suhu_tubuh'],
                'saturasi_oksigen'          => $v['saturasi_oksigen'],
                'tekanan_darah_sistolik'    => $v['tekanan_darah_sistolik'],
                'tekanan_darah_diastolik'   => $v['tekanan_darah_diastolik'],
                'nadi'                      => $v['nadi'],
                'laju_pernapasan'           => $v['laju_pernapasan'],
                'pemeriksaan_penunjang'     => $v['pemeriksaan_penunjang'] ?? null,
                'obat_dikonsumsi_sebelumnya' => $v['obat_dikonsumsi_sebelumnya'] ?? null,
                'diagnosa'                  => $v['diagnosa'],
            ]);

            $userId = auth()->check() ? auth()->user()->id_user : null;

            // Simpan data tindakan
            $tindakanList = json_decode($v['tindakan_data'] ?? '[]', true);
            if (!empty($tindakanList)) {
                foreach ($tindakanList as $t) {
                    if (!empty($t['nama_tindakan']) && !empty($t['alat_id']) && !empty($t['jumlah'])) {
                        $alat = AlatKesehatan::find($t['alat_id']);
                        $namaAlat = $alat ? $alat->nama : 'Alat tidak ditemukan';

                        Resep::create([
                            'tanggal' => now(),
                            'deskripsi' => "{$t['nama_tindakan']} ({$namaAlat})",
                            'jenis_rawat' => 'keterangan berobat',
                            'user_id' => $userId,
                            'pasien_id' => $pasien->id_pasien,
                            'obat_id' => null,
                            'jumlah' => $t['jumlah'],
                            'aturan_pakai' => null,
                            'dosis' => null,
                        ]);
                    }
                }
            }

            // Simpan data resep obat
            $resepList = json_decode($v['resep_data'] ?? '[]', true);
            if (!empty($resepList)) {
                foreach ($resepList as $r) {
                    if (!empty($r['obat_id']) && !empty($r['jumlah']) && !empty($r['aturan_pakai']) && !empty($r['dosis'])) {
                        $obat = Obat::find($r['obat_id']);
                        Resep::create([
                            'tanggal' => now(),
                            'deskripsi' => $obat ? $obat->nama_dagang_obat : 'Obat tidak ditemukan',
                            'jenis_rawat' => 'keterangan berobat',
                            'user_id' => $userId,
                            'pasien_id' => $pasien->id_pasien,
                            'obat_id' => $r['obat_id'],
                            'jumlah' => $r['jumlah'],
                            'aturan_pakai' => $r['aturan_pakai'],
                            'dosis' => $r['dosis'],
                        ]);
                    }
                }
            }
        });

        return redirect()->route('keteranganberobat.index')->with('success', 'keterangan berobat berhasil disimpan.');
    }
}
