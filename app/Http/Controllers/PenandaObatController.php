<?php

namespace App\Http\Controllers;

use App\Models\Penanda;
use Illuminate\Http\Request;

class PenandaObatController extends Controller
{
    public function index()
    {
        $penanda = Penanda::all();
        return view('apoteker.penandaobat', compact('penanda'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penanda' => 'required|string|max:255',
        ]);

        Penanda::create([
            'nama_penanda' => $request->nama_penanda,
        ]);

        return redirect()->route('penanda_obat.index')->with('success', 'Penanda berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penanda' => 'required|string|max:255',
        ]);

        $penanda = Penanda::findOrFail($id);
        $penanda->update([
            'nama_penanda' => $request->nama_penanda,
        ]);

        return redirect()->route('penanda_obat.index')->with('success', 'Penanda berhasil diperbarui.');
    }
}
