<?php

namespace App\Http\Controllers;

use App\Models\ProdukKesehatan;
use App\Models\Golongan;
use App\Models\Satuan;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class ProdukKesehatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $collection = ProdukKesehatan::with(['golongan', 'lokasi', 'satuan'])
            ->when($search, function ($query) use ($search) {
                return $query->where('nama_produkkesehatan', 'like', "%{$search}%")
                             ->orWhere('kode_produkkesehatan', 'like', "%{$search}%");
            })
            ->get()
            ->map(function ($item) {
                $item->kadaluarsa_warning = $item->tgl_kadaluarsa &&
                    Carbon::parse($item->tgl_kadaluarsa)->diffInDays(Carbon::now()) <= 7 &&
                    !Carbon::parse($item->tgl_kadaluarsa)->isPast();
                return $item;
            })
            ->sortByDesc('kadaluarsa_warning')
            ->values();

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;

        $paginated = new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('apoteker.produkkesehatan', [
            'produkKesehatan' => $paginated,
            'search' => $search,
        ]);
    }

    public function create()
    {
        // Data lokasi unik per field untuk dropdown
        $areas = Lokasi::select('area')->distinct()->orderBy('area')->get();
        $raks = Lokasi::select('rak')->distinct()->orderBy('rak')->get();
        $bariss = Lokasi::select('baris')->distinct()->orderBy('baris')->get();
        $koloms = Lokasi::select('kolom')->distinct()->orderBy('kolom')->get();

        return view('apoteker.tambah_produkkesehatan', [
            'areas' => $areas,
            'raks' => $raks,
            'bariss' => $bariss,
            'koloms' => $koloms,
            'golongans' => Golongan::all(),
            'satuans' => Satuan::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produkkesehatan'       => 'required|string|max:50|unique:produkkesehatan,kode_produkkesehatan',
            'nama_produkkesehatan'       => 'required|string|max:255',
            'stok'                       => 'required|integer',
            'harga'                      => 'required|numeric|min:0',
            'bobot_isi'                  => 'nullable|integer',
            'distributor_produkkesehatan'=> 'nullable|string|max:255',
            'tgl_kadaluarsa'             => 'nullable|date',
            'golongan_id'                => 'required|exists:golongan,id_golongan',
            'satuan_id'                  => 'required|exists:satuan,id_satuan',
            'gambar'                     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'area'                      => 'required|string|max:255',
            'rak'                       => 'required|string|max:255',
            'baris'                     => 'required|string|max:255',
            'kolom'                     => 'required|string|max:255',
        ]);

        // Cari atau buat lokasi baru
        $lokasi = Lokasi::firstOrCreate([
            'area' => $request->area,
            'rak' => $request->rak,
            'baris' => $request->baris,
            'kolom' => $request->kolom,
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar-produkkesehatan', 'public');
        }

        // Gabungkan validated data dengan lokasi_id
        ProdukKesehatan::create(array_merge($validated, [
            'lokasi_id' => $lokasi->id_lokasi,
        ]));

        return redirect()->route('produkkesehatan.index')->with('success', 'Produk kesehatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = ProdukKesehatan::with(['golongan', 'lokasi', 'satuan'])->findOrFail($id);

        // Ambil data dropdown untuk lokasi
        $areas = Lokasi::select('area')->distinct()->orderBy('area')->get();
        $raks = Lokasi::select('rak')->distinct()->orderBy('rak')->get();
        $bariss = Lokasi::select('baris')->distinct()->orderBy('baris')->get();
        $koloms = Lokasi::select('kolom')->distinct()->orderBy('kolom')->get();

        return view('apoteker.edit_produkkesehatan', [
            'produk' => $produk,
            'golongans' => Golongan::all(),
            'satuans' => Satuan::all(),
            'areas' => $areas,
            'raks' => $raks,
            'bariss' => $bariss,
            'koloms' => $koloms,
        ]);
    }

    public function update(Request $request, $id)
    {
        $produk = ProdukKesehatan::findOrFail($id);

        $validated = $request->validate([
            'kode_produkkesehatan'       => 'required|string|max:50|unique:produkkesehatan,kode_produkkesehatan,' . $id . ',id_ProdukKesehatan',
            'nama_produkkesehatan'       => 'required|string|max:255',
            'stok'                       => 'required|integer',
            'harga'                      => 'required|numeric|min:0',
            'bobot_isi'                  => 'nullable|integer',
            'distributor_produkkesehatan'=> 'nullable|string|max:255',
            'tgl_kadaluarsa'             => 'nullable|date',
            'golongan_id'                => 'required|exists:golongan,id_golongan',
            'satuan_id'                  => 'required|exists:satuan,id_satuan',
            'gambar'                     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'area'                      => 'required|string|max:255',
            'rak'                       => 'required|string|max:255',
            'baris'                     => 'required|string|max:255',
            'kolom'                     => 'required|string|max:255',
        ]);

        // Cari atau buat lokasi baru
        $lokasi = Lokasi::firstOrCreate([
            'area' => $request->area,
            'rak' => $request->rak,
            'baris' => $request->baris,
            'kolom' => $request->kolom,
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar-produkkesehatan', 'public');
        } else {
            $validated['gambar'] = $produk->gambar;
        }

        $produk->update(array_merge($validated, [
            'lokasi_id' => $lokasi->id_lokasi,
        ]));

        return redirect()->route('produkkesehatan.index')->with('success', 'Produk kesehatan berhasil diperbarui.');
    }
}
