<?php

namespace App\Imports;

use App\Models\Obat;
use App\Models\Golongan;
use App\Models\Penanda;
use App\Models\Lokasi;
use App\Models\Satuan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ObatImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Use isset() or array_key_exists to avoid errors if columns are missing
        return new Obat([
            'kode_obat'          => isset($row['kode_obat']) ? $row['kode_obat'] : 'OBT-' . strtoupper(uniqid()),
            'nama_dagang_obat'   => isset($row['nama_dagang_obat']) ? $row['nama_dagang_obat'] : null,
            'nama_obat'          => isset($row['nama_obat']) ? $row['nama_obat'] : null,  // Ensure this column exists in the file
            'stok'               => isset($row['stok']) ? $row['stok'] : 0,  // Default to 0 if missing
            'harga'              => isset($row['harga']) ? $row['harga'] : 0,  // Default to 0 if missing
            'bobot_isi'          => isset($row['bobot_isi']) ? $row['bobot_isi'] : 0,  // Default to 0 if missing
            'deskripsi'          => isset($row['deskripsi']) ? $row['deskripsi'] : null,
            'tgl_kadaluarsa'     => isset($row['tgl_kadaluarsa']) ? $row['tgl_kadaluarsa'] : null,
            'golongan_id'        => isset($row['golongan_id']) ? $row['golongan_id'] : null, // Foreign key
            'penanda_id'         => isset($row['penanda_id']) ? $row['penanda_id'] : null, // Foreign key
            'satuan_id'          => isset($row['satuan_id']) ? $row['satuan_id'] : null, // Foreign key
            'lokasi_id'          => isset($row['lokasi_id']) ? $row['lokasi_id'] : null, // Foreign key
        ]);
    }
}
