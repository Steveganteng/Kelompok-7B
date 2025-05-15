<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan'; // Nama tabel
    protected $primaryKey = 'id_pemeriksaan'; // Primary key

    protected $fillable = [
        'pasien_id',
        'mulai_diwawati',
        'anamnesis',
        'tinggi_badan',
        'berat_badan',
        'suhu_tubuh',
        'saturasi_oksigen',
        'tekanan_darah_sistolik',
        'tekanan_darah_diastolik',
        'diagnosa',
        'pemeriksaan_penunjang',
        'obat_dikonsumsi_sebelumnya',
        'nadi',
        'laju_pernapasan',
    ];

    /**
     * Relasi ke model Pasien.
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id_pasien');
    }
}
