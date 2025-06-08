<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Golongan;
use App\Models\Penanda;
use App\Models\Lokasi;
use App\Models\Satuan;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;

class ObatController extends Controller
{
    /**
     * Tampilkan form tambah obat.
     */
    public function create()
    {
        return view('apoteker.tambah_dataobat', [
            'golongans'   => Golongan::all(),
            'penandas'    => Penanda::all(),
            'satuans'     => Satuan::all(),
            'lokasis'     => Lokasi::all(),
        ]);
    }

    /**
     * Simpan data obat ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dagang_obat'   => 'required|string|max:255',
            'nama_obat'          => 'required|string|max:255',
            'distributor_obat'   => 'required|string|max:255',
            'stok'               => 'required|integer',
            'harga'              => 'required|numeric',
            'bobot_isi'          => 'required|integer',
            'deskripsi'          => 'nullable|string|max:255',
            'tgl_kadaluarsa'     => 'required|date',
            'gambar'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'golongan_id'        => 'required|exists:golongan,id_golongan',
            'penanda_id'         => 'required|exists:penanda,id_penanda',
            'satuan_id'          => 'required|exists:satuan,id_satuan',
            'area'               => 'required|string|max:255',
            'rak'                => 'required|string|max:100',
            'baris'              => 'required|integer',
            'kolom'              => 'required|integer',
        ]);

        // Generate kode_obat if it's not provided
        $kode_obat = $request->input('kode_obat') ?: 'OBT-' . strtoupper(uniqid());

        // Simpan atau ambil lokasi
        $lokasi = Lokasi::firstOrCreate(
            [
                'area'  => $validated['area'],
                'rak'   => $validated['rak'],
                'baris' => $validated['baris'],
                'kolom' => $validated['kolom'],
            ],
            ['deskripsi' => $validated['deskripsi'] ?? null]
        );

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar-obat', 'public');
        }

        // Buat record baru
        Obat::create([
            'kode_obat'          => $kode_obat, // Add generated kode_obat
            'nama_dagang_obat'   => $validated['nama_dagang_obat'],
            'nama_obat'          => $validated['nama_obat'],
            'distributor_obat'   => $validated['distributor_obat'],
            'stok'               => $validated['stok'],
            'harga'              => $validated['harga'],
            'bobot_isi'          => $validated['bobot_isi'],
            'deskripsi'          => $validated['deskripsi'] ?? '',
            'tgl_kadaluarsa'     => $validated['tgl_kadaluarsa'],
            'gambar'             => $validated['gambar'] ?? 'gambar-obat/default.png',
            'golongan_id'        => $validated['golongan_id'],
            'penanda_id'         => $validated['penanda_id'],
            'satuan_id'          => $validated['satuan_id'],
            'lokasi_id'          => $lokasi->id_lokasi,
        ]);

        return redirect()->route('dataobat')
            ->with('success', 'Data obat berhasil disimpan.');
    }

    /**
     * Tampilkan form edit obat.
     */
    public function edit($id)
    {
        $obat = Obat::with(['golongan', 'penanda', 'lokasi', 'satuan'])
            ->findOrFail($id);

        return view('apoteker.edit_dataobat', [
            'obat'         => $obat,
            'golongans'    => Golongan::all(),
            'penandas'     => Penanda::all(),
            'satuans'      => Satuan::all(),
            'areaOptions'  => Lokasi::select('area')->distinct()->orderBy('area')->pluck('area'),
            'rakOptions'   => Lokasi::select('rak')->distinct()->orderBy('rak')->pluck('rak'),
            'barisOptions' => Lokasi::select('baris')->distinct()->orderBy('baris')->pluck('baris'),
            'kolomOptions' => Lokasi::select('kolom')->distinct()->orderBy('kolom')->pluck('kolom'),
        ]);
    }

    /**
     * Update data obat.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_dagang_obat'   => 'required|string|max:255',
            'nama_obat'          => 'required|string|max:255',
            'distributor_obat'   => 'required|string|max:255',
            'stok'               => 'required|integer',
            'harga'              => 'required|numeric',
            'bobot_isi'          => 'required|integer',
            'deskripsi'          => 'nullable|string|max:255',
            'tgl_kadaluarsa'     => 'required|date',
            'gambar'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'area'               => 'required|string|max:255',
            'rak'                => 'required|string|max:100',
            'baris'              => 'required|integer',
            'kolom'              => 'required|integer',
        ]);

        $obat = Obat::findOrFail($id);

        // Update atau buat lokasi
        $lokasi = Lokasi::firstOrCreate(
            [
                'area'  => $validated['area'],
                'rak'   => $validated['rak'],
                'baris' => $validated['baris'],
                'kolom' => $validated['kolom'],
            ],
            ['deskripsi' => $validated['deskripsi'] ?? null]
        );

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            $obat->gambar = $request->file('gambar')->store('gambar-obat', 'public');
        }

        // Simpan perubahan
        $obat->update([
            'nama_dagang_obat'  => $validated['nama_dagang_obat'],
            'nama_obat'         => $validated['nama_obat'],
            'distributor_obat'  => $validated['distributor_obat'],
            'stok'              => $validated['stok'],
            'harga'             => $validated['harga'],
            'bobot_isi'         => $validated['bobot_isi'],
            'deskripsi'         => $validated['deskripsi'] ?? '',
            'tgl_kadaluarsa'    => $validated['tgl_kadaluarsa'],
            'lokasi_id'         => $lokasi->id_lokasi,
        ]);

        return redirect()->route('dataobat')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    /**
     * Daftar semua obat dengan pagination manual.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $collection = Obat::with(['golongan', 'penanda', 'lokasi', 'satuan'])
            ->when($search, function ($q) use ($search) {
                return $q->where('nama_dagang_obat', 'like', "%{$search}%")
                    ->orWhere('nama_obat', 'like', "%{$search}%");
            })
            ->get()
            ->map(function ($o) {
                $o->kadaluarsa_warning = $o->tgl_kadaluarsa
                    && $o->tgl_kadaluarsa->diffInDays(Carbon::now()) <= 7
                    && ! $o->tgl_kadaluarsa->isPast();
                return $o;
            })
            ->sortByDesc('kadaluarsa_warning')
            ->values();

        // Pagination manual
        $page    = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $paginated = new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('apoteker.dataobat', [
            'obats'  => $paginated,
            'search' => $search,
        ]);
    }

    public function uploadFile(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,txt',
        ]);

        // Ambil file CSV
        $file = $request->file('file');

        // Proses file CSV menggunakan Laravel Excel
        $data = Excel::toArray([], $file);
        // dd($data);

        // Iterasi melalui data yang dibaca dari file (data berada dalam array pertama)
        foreach ($data[0] as $index => $row) {
            // Lewati baris pertama yang berisi header
            if ($index == 0) continue;

            // Generate kode_obat jika tidak ada
            $kode_obat = 'OBT-' . strtoupper(uniqid());

            // Buat atau ambil lokasi (jika tidak ada)
            $lokasi = Lokasi::firstOrCreate(
                [
                    'area'  => $row[12],  // Area Lokasi
                    'rak'   => $row[13],  // Rak
                    'baris' => (int)$row[14],  // Baris
                    'kolom' => (int)$row[15],  // Kolom
                ],
                ['deskripsi' => $row[16] ?? null]  // Deskripsi Lokasi
            );

            $golongan = Golongan::where('NamaGolongan', $row[4])->first(); // Use first() to get a single model

            if ($golongan) {
                $golongan_id = $golongan->id_golongan;  // Access the id_golongan of the first record
                // Dump and die to check the result
            } else {
                return; // If no result is found
            }


            $penanda = Penanda::where('nama_penanda', $row[5])->first();
            // dd('haisss');
            if ($penanda) {
                $penanda_id = $penanda->id_penanda;  // Access the id_golongan of the first record
                // dd($penanda_id);
                // Dump and die to check the result
            } else {
                return; // If no result is found

            }
            $satuan = Satuan::where('nama_satuan',  $row[6])->first();

            if ($satuan) {
                $satuan_id = $satuan->id_satuan;
                // dd($satuan_id);
            } else {
                dd('kososng');
            }



            // Simpan data obat ke dalam database
            Obat::create([
                'kode_obat'          => $kode_obat,
                'nama_dagang_obat'   => $row[1],  // Nama Dagang Obat
                'nama_obat'          => $row[2],  // Nama Generik Obat
                'distributor_obat'   => $row[3],  // Distributor Obat
                'stok'               => (int)$row[9],  // Stok
                'harga'              => (float)$row[8],  // Harga
                'bobot_isi'          => (int)$row[7],  // Bobot Isi (mg)
                'deskripsi'          => $row[11] ?? '',  // Deskripsi Obat
                'tgl_kadaluarsa'     => $row[10],
                'gambar'             => 'gambar-obat/default.png',  // Tanggal Kadaluarsa
                'golongan_id'        => $golongan_id,  // Golongan
                'penanda_id'         => $penanda_id,  // Penanda
                'satuan_id'          => $satuan_id,  // Satuan Kemasan
                'lokasi_id'          => $lokasi->id_lokasi,  // Lokasi
            ]);


        }
        return redirect()->route('dataobat')
                ->with('success', 'Data obat berhasil diimpor dan disimpan.');
    }
}
