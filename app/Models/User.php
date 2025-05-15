<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Tentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'username', 'email', 'password', 'role', // Updated 'name' to 'username'
    ];

    // Menyembunyikan kolom password
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Format kolom tanggal
    protected $dates = [
        'email_verified_at',
    ];
}
