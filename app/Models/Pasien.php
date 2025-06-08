<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';

    protected $fillable = [
        'nama_pasien',
        'tanggal_lahir',
        'jenis_kelamin',
        'jenis_pemeriksaan',
        'alamat',
        'telepon',
    ];

    // Define the relationship with Resep (one Pasien can have many Resep)
    public function reseps()
    {
        return $this->hasMany(Resep::class, 'pasien_id', 'id_pasien');
    }

    // You can also define other relationships if needed, such as for Pemeriksaan
    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class, 'pasien_id', 'id_pasien');
    }
}
