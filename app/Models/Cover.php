<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul', 
        'logo_instansi',
        'logo_umum'
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

}
