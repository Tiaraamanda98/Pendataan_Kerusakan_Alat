<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nama_instansi',
        'alamat',
        'no_telp',
        'foto_profil',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function teknisis()
    {
        return $this->hasMany(Teknisi::class);
    }

    public function kliens()
    {
        return $this->hasMany(Klien::class);
    }

    public function covers()
    {
        return $this->hasMany(Cover::class);
    }
}
