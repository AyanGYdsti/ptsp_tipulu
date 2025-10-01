<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $guarded = ['id'];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik');
    }

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class, 'pelayanan_id');
    }

    public function dokumenPersyaratan()
    {
        return $this->hasMany(DokumenPersyaratan::class, 'pengajuan_id');
    }

    public function verifikasiByAparatur($aparaturId)
    {
        return $this->hasMany(Verifikasi::class, 'pengajuan_id')
            ->where('aparatur_id', $aparaturId);
    }

    public function kematian()
    {
        return $this->hasOne(Kematian::class);
    }

    public function pindahPenduduk()
    {
        return $this->hasOne(PindahPenduduk::class);
    }

    public function domisiliUsahaYayasan()
    {
        return $this->hasOne(domisiliUsahaYayasan::class);
    }

    public function usaha()
    {
        return $this->hasOne(Usaha::class);
    }

}
