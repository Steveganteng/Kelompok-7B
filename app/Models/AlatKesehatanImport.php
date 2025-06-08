<?php

namespace App\Imports;

use App\Models\AlatKesehatan;
use App\Models\Lokasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlatKesehatanImport implements ToModel, WithHeadingRow
{
    /**
     * Transform the imported data into a model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Use isset() or array_key_exists to avoid errors if columns are missing
        return new AlatKesehatan([
            'nama'              => isset($row['nama']) ? $row['nama'] : null,  // Default null if missing
            'jenis'             => isset($row['jenis']) ? $row['jenis'] : null,  // Default null if missing
            'kode_alat'         => isset($row['kode_alat']) ? $row['kode_alat'] : 'ALAT-' . strtoupper(uniqid()),
            'distributor_alat'  => isset($row['distributor_alat']) ? $row['distributor_alat'] : null,
            'stok'              => isset($row['stok']) ? $row['stok'] : 0,  // Default to 0 if missing
            'gambar'            => isset($row['gambar']) ? $row['gambar'] : null,  // Default null if missing
            'lokasi_id'         => isset($row['lokasi_id']) ? $row['lokasi_id'] : null, // Foreign key
            'status'            => isset($row['status']) ? $row['status'] : 'Available',  // Default to Available if missing
        ]);
    }
}
