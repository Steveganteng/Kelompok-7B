<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\ResepObat;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    /**
     * Display a listing of the prescriptions (Resep).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all resep data along with pasien and multiple obat relations (many-to-many)
        $reseps = Resep::with(['pasien', 'obats', 'user'])->get();

        // Pass the data to the view
        return view('apoteker.resepobat', compact('reseps'));
    }

    /**
     * Store a newly created prescription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create a new prescription and set the default status to 'belum diberikan'
        $resep = new Resep();
        $resep->tanggal = $request->tanggal;
        $resep->deskripsi = $request->deskripsi;
        $resep->jenis_rawat = $request->jenis_rawat;
        $resep->user_id = $request->user_id;
        $resep->pasien_id = $request->pasien_id;
        $resep->status = 'belum diberikan'; // Set the default status

        // Save the prescription
        $resep->save();

        // Optionally, you can attach related medications (obats)
        if ($request->has('obat_id')) {
            $resep->obats()->attach($request->obat_id, [
                'jumlah' => $request->jumlah,
                'aturan_pakai' => $request->aturan_pakai,
                'dosis' => $request->dosis
            ]);
        }

        return back()->with('success', 'Resep berhasil dibuat dengan status "belum diberikan".');
    }

    /**
     * Update the status of the prescription to 'sudah diberikan' (given).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serahkan($id)
    {
        // Find the prescription
        $resep = Resep::find($id);

        if ($resep) {
            // Update the status to 'sudah diberikan'
            $resep->status = 'sudah diberikan';
            $resep->save();
            return back()->with('success', 'Resep berhasil diserahkan.');
        }

        return back()->with('error', 'Resep tidak ditemukan.');
    }


public function ngubahStatus()
{
    // Ambil 2 data pertama yang belum diberikan
    $reseps = ResepObat::where('status', 'belum diberikan')
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get();

    // Jika tidak ada data yang ditemukan
    if ($reseps->isEmpty()) {
        return response()->json(['message' => 'Tidak ada resep yang bisa diubah'], 404);
    }

    // Ubah status masing-masing menjadi "sudah diberikan"
    foreach ($reseps as $resep) {
        $resep->status = 'sudah diberikan';
        $resep->save();
    }

    return response()->json([
        'message' => 'Status 2 resep berhasil diubah',
        'jumlah_diubah' => $reseps->count()
    ]);
}



    /**
     * Update the status of the prescription.
     *
     * @param  int  $id
     * @param  string  $status
     * @return \Illuminate\Http\Response
     */
   public function updateStatus(Request $request, $id)
{
    $resep = Resep::find($id);

    if ($resep) {
        $status = $request->input('status');  // Ambil status dari request

        // Validasi status yang boleh diinput
        if (!in_array($status, ['belum diberikan', 'sudah diberikan'])) {
            return response()->json(['error' => 'Status tidak valid.'], 400);
        }

        $resep->status = $status;
        $resep->save();

        return response()->json(['success' => 'Status resep berhasil diperbarui.']);
    }

    // Return jika resep tidak ditemukan
    return response()->json(['error' => 'Resep tidak ditemukan.'], 404);
}


}
