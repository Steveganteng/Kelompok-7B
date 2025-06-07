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
        'kode_produkkesehatan',
        'nama_produkkesehatan',
        'stok',
        'harga',
        'bobot_isi',
        'gambar',
        'distributor_produkkesehatan',
        'golongan_id',
        'penanda_id',
        'lokasi_id',
        'satuan_id',
        'tgl_kadaluarsa',
    ];

    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id', 'id_golongan');
    }

    public function penanda()
    {
        return $this->belongsTo(Penanda::class, 'penanda_id', 'id_penanda');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id', 'id_lokasi');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id_satuan');
    }
}
