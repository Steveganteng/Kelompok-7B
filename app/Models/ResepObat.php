<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;

    protected $table = 'resep_obat';

    // Disable auto-incrementing for pivot tables
    public $incrementing = false;

    // Define the foreign keys and fillable columns
    protected $fillable = [
        'resep_id',
        'obat_id',
        'jumlah',
        'aturan_pakai',
        'dosis',
        'status',  // Include the new 'status' column here
    ];

    // Define the relationship with Resep
    public function resep()
    {
        return $this->belongsTo(Resep::class, 'resep_id');
    }

    // Define the relationship with Obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
