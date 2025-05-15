<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';
    protected $primaryKey = 'id_obat';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'NamaObat',
        'stok',
        'deskripsi',
        'harga',
        'bobot_isi',
        'gambar',
        'golongan_id',
        'penanda_id',
        'lokasi_id',
        'satuan_id',
    ];

    // Relasi ke golongan
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id', 'id_golongan');
    }

    // Relasi ke penanda
    public function penanda()
    {
        return $this->belongsTo(Penanda::class, 'penanda_id', 'id_penanda');
    }

    // Relasi ke lokasi
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id', 'id_lokasi');
    }

    // Relasi ke satuan
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id_satuan');
    }
}
