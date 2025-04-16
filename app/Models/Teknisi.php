<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    use HasFactory;
    protected $table = 'teknisis';
    protected $fillable = [
        'user_id',
        'nama_teknisi',
        'no_telp',
        'email',
        'password',
        'konfirmasi_password',
    ];

    public function keluhan()
    {
        return $this->hasMany(Klien::class, 'teknisi_id');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
