<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'resep';
    protected $primaryKey = 'id_resep';

    protected $fillable = [
        'tanggal',
        'deskripsi',
        'jenis_rawat',
        'user_id',
        'pasien_id',
        'obat_id',
        'jumlah',
        'aturan_pakai',
        'dosis',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    // Relasi ke Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id_pasien');
    }

    // Relasi ke Obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id', 'id_obat');
    }
}
