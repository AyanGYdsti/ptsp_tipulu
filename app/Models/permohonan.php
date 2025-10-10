<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $fillable = [
        'pelayanan_id',
        'nik',
    ];

    public function pelayanan()
    {
        return $this->hasMany(Pelayanan::class, 'pelayanan_id', 'id');
    }
    public function masyarakat()
    {
        return $this->hasMany(Masyarakat::class, 'nik', 'nik');
    }
}
