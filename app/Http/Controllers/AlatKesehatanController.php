<?php

namespace App\Http\Controllers;

use App\Models\AlatKesehatan;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class AlatKesehatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Paginate results instead of getting all data
        $alatKesehatans = AlatKesehatan::with(['lokasi'])
            ->when($search, function ($query) use ($search) {
                return $query->where('nama', 'like', "%{$search}%")
                             ->orWhere('kode_alat', 'like', "%{$search}%");
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
            $alatKesehatans->forPage($page, $perPage),
            $alatKesehatans->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('apoteker.alatkesehatan', [
            'alatKesehatans' => $paginated,
            'search' => $search,
        ]);
    }

    public function create()
{
    // Fetch unique values for 'area', 'rak', 'baris', 'kolom'
    $areas = Lokasi::select('area')->distinct()->orderBy('area')->get();
    $raks = Lokasi::select('rak')->distinct()->orderBy('rak')->get();
    $bariss = Lokasi::select('baris')->distinct()->orderBy('baris')->get();
    $koloms = Lokasi::select('kolom')->distinct()->orderBy('kolom')->get();

    return view('apoteker.tambah_alatkesehatan', [
        'areas' => $areas,
        'raks' => $raks,
        'bariss' => $bariss,
        'koloms' => $koloms,
    ]);
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_alat' => 'required|string|max:50|unique:alatkesehatan,kode_alat',
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer',
            'bobot_isi' => 'nullable|integer',
            'distributor_alat' => 'nullable|string|max:255',
            'tgl_kadaluarsa' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'area' => 'required|string|max:255',
            'rak' => 'required|string|max:255',
            'baris' => 'required|string|max:255',
            'kolom' => 'required|string|max:255',
        ]);

        // Create or find existing lokasi
        $lokasi = Lokasi::firstOrCreate([
            'area' => $request->area,
            'rak' => $request->rak,
            'baris' => $request->baris,
            'kolom' => $request->kolom,
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar-alatkesehatan', 'public');
        }

        // Combine validated data with lokasi_id and create new record
        AlatKesehatan::create(array_merge($validated, [
            'lokasi_id' => $lokasi->id_lokasi,
        ]));

        return redirect()->route('alatkesehatan.index')->with('success', 'Alat kesehatan berhasil ditambahkan.');
    }
// In AlatKesehatanController.php

public function updateStatus(Request $request, $id)
{
    $validated = $request->validate([
        'status' => 'required|string|in:Available,Unavailable',  // Ensure status is either 'Available' or 'Unavailable'
    ]);

    // Find the alat (medical tool) by ID and update its status
    $alat = AlatKesehatan::findOrFail($id);
    $alat->status = $validated['status'];  // Update the status field

    $alat->save();  // Save the updated status to the database

    return redirect()->route('alatkesehatan.index')->with('success', 'Status alat kesehatan berhasil diperbarui.');
}

    public function edit($id)
    {
        $alat = AlatKesehatan::with(['lokasi'])->findOrFail($id);

        // Get dropdown data for location
        $areas = Lokasi::select('area')->distinct()->orderBy('area')->get();
        $raks = Lokasi::select('rak')->distinct()->orderBy('rak')->get();
        $bariss = Lokasi::select('baris')->distinct()->orderBy('baris')->get();
        $koloms = Lokasi::select('kolom')->distinct()->orderBy('kolom')->get();

        return view('apoteker.edit_alatkesehatan', [
            'alat' => $alat,
            'areas' => $areas,  // Corrected variable name
            'raks' => $raks,
            'bariss' => $bariss,
            'koloms' => $koloms,
        ]);
    }

    public function update(Request $request, $id)
    {
        $alat = AlatKesehatan::findOrFail($id);

        $validated = $request->validate([
            'kode_alat' => 'required|string|max:50|unique:alatkesehatan,kode_alat,' . $id . ',id_AlatKesehatan',
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer',
            'bobot_isi' => 'nullable|integer',
            'distributor_alat' => 'nullable|string|max:255',
            'tgl_kadaluarsa' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'area' => 'required|string|max:255',
            'rak' => 'required|string|max:255',
            'baris' => 'required|string|max:255',
            'kolom' => 'required|string|max:255',
        ]);

        // Create or find existing lokasi
        $lokasi = Lokasi::firstOrCreate([
            'area' => $request->area,
            'rak' => $request->rak,
            'baris' => $request->baris,
            'kolom' => $request->kolom,
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar-alatkesehatan', 'public');
        } else {
            $validated['gambar'] = $alat->gambar;
        }

        // Update the record with validated data and location ID
        $alat->update(array_merge($validated, [
            'lokasi_id' => $lokasi->id_lokasi,
        ]));

        return redirect()->route('alatkesehatan.index')->with('success', 'Alat kesehatan berhasil diperbarui.');
    }
}
