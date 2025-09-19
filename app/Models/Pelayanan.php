<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $fillable = [
        'nama',
    ];

    public function pelayananPersyaratan()
    {
        return $this->hasMany(PelayananPersyaratan::class, 'pelayanan_id', 'id');
    }
}
