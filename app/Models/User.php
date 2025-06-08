<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    // Define the table associated with the model (optional)
    protected $table = 'users';

    // Define the primary key column (optional)
    protected $primaryKey = 'id_user';

    // Disable timestamps if your table doesn't use them (optional)
    public $timestamps = true;

    // Define the attributes that are mass assignable
    protected $fillable = [
        'username',
        'password',
        'email',
        'role',
    ];

    // Define any attributes that should be hidden (e.g., password)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast any necessary attributes (for instance, casting a timestamp)
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Optionally, define relationships (if applicable)
    // public function posts() {
    //     return $this->hasMany(Post::class);
    // }
}
