<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'satuan';
    protected $primaryKey = 'id_satuan';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama_satuan'];
}
