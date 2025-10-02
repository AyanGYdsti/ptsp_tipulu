<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatTinggalSementara extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tempat_tinggal_sementaras'; // Sesuaikan jika nama tabel Anda berbeda

    protected $fileable = [
        'pengajuan_id',
        'alamat_sementara',
        'nik',
        'nama',
        'jenis_kelamin',
        'RT',
        'RW',
        'tgl_lahir',
        'tempat_lahir',
        'agama',
    ];
    /**
     * Mendefinisikan relasi inverse one-to-one ke Pengajuan.
     */
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
