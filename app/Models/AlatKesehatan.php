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
        'stok',
        'deskripsi',
        'gambar',
        'golongan_id',
        'penanda_id',
        'lokasi_id',
        'satuan_id',
        'status',
    ];

    // Relasi ke tabel golongan
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id', 'id_golongan');
    }

    // Relasi ke tabel penanda
    public function penanda()
    {
        return $this->belongsTo(Penanda::class, 'penanda_id', 'id_penanda');
    }

    // Relasi ke tabel lokasi
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id', 'id_lokasi');
    }

    // Relasi ke tabel satuan
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id_satuan');
    }
}
