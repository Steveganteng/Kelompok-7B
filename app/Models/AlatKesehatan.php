<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatKesehatan extends Model
{
    use HasFactory;

    protected $table = 'alatkesehatan';
    protected $primaryKey = 'id_AlatKesehatan';

    protected $fillable = [
        'nama',
        'jenis',
        'kode_alat',
        'distributor_alat',
        'stok',
        'gambar',
        'lokasi_id',
        'status',
    ];


    // Relasi ke tabel lokasi
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id', 'id_lokasi');
    }

}
