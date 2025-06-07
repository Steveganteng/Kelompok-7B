<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien'; // Nama tabel
    protected $primaryKey = 'id_pasien'; // Primary key

    protected $fillable = [
        'nama_pasien',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'telepon',
    ];

    /**
     * Relasi one-to-many ke pemeriksaan
     */
    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class, 'pasien_id', 'id_pasien');
    }
}
