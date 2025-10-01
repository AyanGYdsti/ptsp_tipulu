<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('domisili_usaha_yayasan', function (Blueprint $table) {
            $table->id();
            // relasi ke pengajuans
            $table->foreignId('pengajuan_id')
                  ->constrained('pengajuans')
                  ->onDelete('cascade');

            $table->string('nama_usaha')->nullable();
            $table->string('jenis_kegiatan_usaha')->nullable();
            $table->string('alamat_usaha')->nullable();
            $table->string('penanggung_jawab')->nullable();
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
