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
    ];

    // Define many-to-many relationship with Obat
    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'resep_obat', 'resep_id', 'obat_id')
                    ->withPivot('jumlah', 'aturan_pakai', 'dosis', 'status')  // Including 'status' in the pivot data
                    ->withTimestamps();
    }

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship with Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}
