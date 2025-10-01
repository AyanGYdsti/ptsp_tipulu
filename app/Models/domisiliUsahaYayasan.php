<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class domisiliUsahaYayasan extends Model
{

    use HasFactory;

    protected $table = 'domisili_usaha_yayasan';

    protected $fillable = [
        'pengajuan_id',
        'nama_usaha',
        'jenis_kegiatan_usaha',
        'alamat_usaha',
        'penanggung_jawab',
        
    ];

    // relasi ke pengajuan
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
