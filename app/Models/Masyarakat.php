<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    protected $guarded = ['id'];
    protected $primaryKey = 'nik';

    public function dokumenPersyaratan()
    {
        return $this->hasMany(DokumenPersyaratan::class, 'nik');
    }
}
