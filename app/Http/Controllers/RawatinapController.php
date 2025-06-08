<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\Resep;
use App\Models\Obat;
use App\Models\ResepObat;
use App\Models\AlatKesehatan;

class rawatinapController extends Controller
{
    /**
     * Display a list of rawat inap (patients and their prescriptions, etc. - can be customized)
     */
 public function index()
{
    // Fetch only patients with 'rawat inap' pemeriksaan, and their associated reseps
    $rawatinap = Pasien::whereHas('pemeriksaan', function ($query) {
        $query->where('jenis_pemeriksaan', 'rawat inap');
    })
    ->with('reseps')  // Eager load the reseps relation
    ->get();

    // Pass the filtered data to the view
    return view('dokter.rawatinap', compact('rawatinap'));
}
    /**
     * Show the form for creating a new rawat inap
     */
    public function create()
    {
        // Fetch all medicines and medical instruments for the form
        $obats = Obat::all();
        $alatKesehatan = AlatKesehatan::all();
        return view('dokter.tambah_rawatinap', compact('obats', 'alatKesehatan'));
    }

    /**
     * Store a newly created rawat inap in the database
     */
  public function store(Request $request)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'nama_pasien' => 'required|string',
        'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
        'tempat_lahir' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'telepon' => 'required|string',
        'mulai_diwawati' => 'required|date_format:Y-m-d\TH:i',
        'anamnesis' => 'nullable|string',
        'tinggi_badan' => 'required|integer',
        'berat_badan' => 'required|integer',
        'suhu_tubuh' => 'required|numeric',
        'saturasi_oksigen' => 'required|integer',
        'tekanan_darah_sistolik' => 'required|integer',
        'tekanan_darah_diastolik' => 'required|integer',
        'nadi' => 'required|integer',
        'laju_pernapasan' => 'required|integer',
        'pemeriksaan_penunjang' => 'nullable|string',
        'obat_dikonsumsi_sebelumnya' => 'nullable|string',
        'diagnosa' => 'required|string',
        'resep_data' => 'nullable|string',  // JSON data for prescriptions
    ]);

    // Start a transaction to ensure data consistency
    DB::transaction(function () use ($validatedData) {
        // Tentukan jenis pemeriksaan dengan nilai default 'rawat inap'
        $jenisPemeriksaan = 'rawat inap';  // Set default to 'rawat inap'

        // Store the patient (pasien) data with jenis_pemeriksaan
        $pasien = Pasien::create([
            'nama_pasien' => $validatedData['nama_pasien'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'alamat' => $validatedData['alamat'],
            'telepon' => $validatedData['telepon'],
            'jenis_pemeriksaan' => $jenisPemeriksaan,  // Set jenis_pemeriksaan to 'rawat inap' by default
        ]);

        // Store the pemeriksaan (examination) data
        Pemeriksaan::create([
            'pasien_id' => $pasien->id_pasien,
            'mulai_diwawati' => $validatedData['mulai_diwawati'],
            'anamnesis' => $validatedData['anamnesis'],
            'tinggi_badan' => $validatedData['tinggi_badan'],
            'berat_badan' => $validatedData['berat_badan'],
            'suhu_tubuh' => $validatedData['suhu_tubuh'],
            'saturasi_oksigen' => $validatedData['saturasi_oksigen'],
            'tekanan_darah_sistolik' => $validatedData['tekanan_darah_sistolik'],
            'tekanan_darah_diastolik' => $validatedData['tekanan_darah_diastolik'],
            'nadi' => $validatedData['nadi'],
            'laju_pernapasan' => $validatedData['laju_pernapasan'],
            'pemeriksaan_penunjang' => $validatedData['pemeriksaan_penunjang'],
            'obat_dikonsumsi_sebelumnya' => $validatedData['obat_dikonsumsi_sebelumnya'],
            'diagnosa' => $validatedData['diagnosa'],
        ]);

        // Handle prescriptions data
        $resepList = json_decode($validatedData['resep_data'] ?? '[]', true);
        if (!empty($resepList)) {
            $resep = Resep::create([
                'tanggal' => now(),
                'deskripsi' => 'Resep obat untuk pasien',
                'jenis_rawat' => $jenisPemeriksaan,  // Sesuaikan jenis rawat untuk resep
                'user_id' => auth()->check() ? auth()->user()->id_user : null,
                'pasien_id' => $pasien->id_pasien,
            ]);

            // Attach each prescription (medication) to the resep (prescription)
            foreach ($resepList as $r) {
                if (!empty($r['obat_id']) && !empty($r['jumlah']) && !empty($r['aturan_pakai']) && !empty($r['dosis'])) {
                    $obat = Obat::find($r['obat_id']);
                    ResepObat::create([ // Save each medication into the pivot table
                        'resep_id' => $resep->id_resep,
                        'obat_id' => $obat->id_obat,
                        'jumlah' => $r['jumlah'],
                        'aturan_pakai' => $r['aturan_pakai'],
                        'dosis' => $r['dosis'],
                        'status' => 'belum diberikan'  // Set the default status for each obat
                    ]);
                }
            }
        }
    });

    return redirect()->route('rawatinap.index')->with('success', 'rawat inap berhasil disimpan.');
}

}
