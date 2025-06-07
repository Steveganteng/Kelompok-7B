<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';
    protected $primaryKey = 'id_obat';

    protected $fillable = [
        'kode_obat', 'nama_dagang_obat', 'nama_obat', 'stok', 'deskripsi',
        'harga', 'bobot_isi', 'gambar', 'distributor_obat', 'golongan_id',
        'penanda_id', 'lokasi_id', 'satuan_id', 'tgl_kadaluarsa',
    ];
        // Automatically cast tgl_kadaluarsa to a Carbon instance
    protected $casts = [
        'tgl_kadaluarsa' => 'datetime',
    ];

    // Relationship with Golongan
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id', 'id_golongan');
    }

    // Relationship with Penanda
    public function penanda()
    {
        return $this->belongsTo(Penanda::class, 'penanda_id', 'id_penanda');
    }

    // Relationship with Satuan
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id_satuan');
    }

    // Relationship with Lokasi
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id', 'id_lokasi');
    }

    // Define many-to-many relationship with Resep
    public function reseps()
    {
        return $this->belongsToMany(Resep::class, 'resep_obat')
                    ->withPivot('jumlah', 'aturan_pakai', 'dosis')
                    ->withTimestamps();  // Timestamps for pivot table
    }
}
