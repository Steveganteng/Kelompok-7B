<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKesehatan extends Model
{
    use HasFactory;

    protected $table = 'produkkesehatan';

    protected $primaryKey = 'id_ProdukKesehatan';

    protected $fillable = [
        'nama',
        'stok',
        'gambar',
        'lokasi_id',
        'satuan_id',
    ];

    // Relasi ke Lokasi
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id', 'id_lokasi');
    }

    // Relasi ke Satuan
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id_satuan');
    }
}
