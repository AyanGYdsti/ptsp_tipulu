<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pindah_penduduk', function (Blueprint $table) {
        $table->id();

        $table->string('desa_kelurahan', 100);
        $table->string('kecamatan', 100);
        $table->string('kab_kota', 100);
        $table->string('provinsi', 100);

        $table->date('tanggal_pindah'); 
        $table->string('alasan_pindah', 255)->nullable(); // alasan bisa kosong/null

        $table->integer('pengikut')->default(0); // jumlah pengikut, default 0

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pindah_penduduk');
    }
};
