<?php

namespace App\Imports;

use App\Models\ProdukKesehatan;
use App\Models\Golongan;
use App\Models\Penanda;
use App\Models\Lokasi;
use App\Models\Satuan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProdukKesehatanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Use isset() or array_key_exists to avoid errors if columns are missing
        return new ProdukKesehatan([
            'kode_produkkesehatan'      => isset($row['kode_produkkesehatan']) ? $row['kode_produkkesehatan'] : 'PRODUK-' . strtoupper(uniqid()),
            'nama_produkkesehatan'     => isset($row['nama_produkkesehatan']) ? $row['nama_produkkesehatan'] : null,
            'stok'                     => isset($row['stok']) ? $row['stok'] : 0,  // Default to 0 if missing
            'harga'                    => isset($row['harga']) ? $row['harga'] : 0,  // Default to 0 if missing
            'bobot_isi'                => isset($row['bobot_isi']) ? $row['bobot_isi'] : 0,  // Default to 0 if missing
            'gambar'                   => isset($row['gambar']) ? $row['gambar'] : 'gambar-produk/default.png',
            'distributor_produkkesehatan' => isset($row['distributor_produkkesehatan']) ? $row['distributor_produkkesehatan'] : null,
            'tgl_kadaluarsa'           => isset($row['tgl_kadaluarsa']) ? $row['tgl_kadaluarsa'] : null,
            'golongan_id'              => isset($row['golongan_id']) ? $row['golongan_id'] : null,  // Foreign key
            'penanda_id'               => isset($row['penanda_id']) ? $row['penanda_id'] : null,  // Foreign key
            'satuan_id'                => isset($row['satuan_id']) ? $row['satuan_id'] : null,  // Foreign key
            'lokasi_id'                => isset($row['lokasi_id']) ? $row['lokasi_id'] : null,  // Foreign key
        ]);
    }
}
