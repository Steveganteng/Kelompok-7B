<?php

// app/Models/Resep.php

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
        'status',
        'jenis_rawat',
        'user_id',
        'pasien_id',
        'jumlah',
        'aturan_pakai',
        'dosis',
    ];

    // Many-to-many relationship with Obat (Pivot relationship)
    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'resep_obat', 'resep_id', 'obat_id')
                    ->withPivot('jumlah', 'aturan_pakai', 'dosis');
    }

    // Relasi ke Pasien (setiap baris resep berkaitan dengan satu pasien)
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id_pasien');
    }
     public function user()
    {
        return $this->belongsTo(Pasien::class, 'user_id', 'id_user');
    }
}
