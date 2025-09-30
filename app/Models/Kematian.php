<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kematian extends Model
{
    use HasFactory;

    protected $table = 'kematians'; 

    protected $fillable = [
        'pengajuan_id',
        'nama',
        'jenis_kelamin',
        'umur',
        'alamat',
        'tanggal_meninggal',
        'hari',
        'tempat_meninggal',
        'penyebab',
    ];

    // relasi ke pengajuan
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
