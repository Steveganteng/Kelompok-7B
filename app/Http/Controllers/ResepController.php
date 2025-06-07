<?php

namespace App\Http\Controllers;

use App\Models\Resep;
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
     * Update the status of the prescription.
     *
     * @param  int  $id
     * @param  string  $status
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id, $status)
    {
        // Validate status
        if (!in_array($status, ['belum diberikan', 'sudah diberikan'])) {
            return back()->with('error', 'Status tidak valid.');
        }

        // Find the prescription
        $resep = Resep::find($id);

        if ($resep) {
            $resep->status = $status;
            $resep->save();
            return back()->with('success', 'Status resep berhasil diperbarui.');
        }

        return back()->with('error', 'Resep tidak ditemukan.');
    }
}
