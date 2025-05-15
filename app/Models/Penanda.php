<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penanda extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'penanda';

    // Primary key custom
    protected $primaryKey = 'id_penanda';

    // Jika primary key bukan auto increment integer default 'id'
    public $incrementing = true;

    // Jika primary key bukan tipe integer (tidak perlu kalau tetap integer)
    protected $keyType = 'int';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_penanda',
    ];
}
