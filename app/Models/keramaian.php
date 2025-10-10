<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keramaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'nama_acara',
        'penyelenggara',
        'deskripsi_acara',
        'tanggal',
        'tempat',
        'pukul' ,
    ];

    /**
     * Relasi ke tabel Pengajuan
     */
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
