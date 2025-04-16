<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    use HasFactory;

  
    protected $fillable = [
        'user_id',
        'teknisi_id',
        'id_tiket',
        'keluhan', 
        'klien',
        'unit', 
        'deskripsi', 
        'tgl_keluhan', 
        'jam', 
        'gambar',
        'gambar_perbaikan',
        'status',
        'deskripsi_perbaikan',
        'tgl_perbaikan',
        'durasi_perbaikan',
        'nama_pelapor',
        
    ];
 
public function user()
{
    return $this->belongsTo(User::class);
}


public function teknisi()
{
    return $this->belongsTo(User::class, 'teknisi_id');
}


    
}
