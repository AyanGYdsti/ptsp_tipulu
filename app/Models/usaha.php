<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{

    use HasFactory;

    protected $table = 'usaha';

    protected $fillable = [
        'pengajuan_id',
        'nama_usaha',
        'tahun_berdiri',
    ];

    // relasi ke pengajuan
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
