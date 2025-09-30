<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kematians', function (Blueprint $table) {
            $table->id();
            // relasi ke pengajuans
            $table->foreignId('pengajuan_id')
                  ->constrained('pengajuans')
                  ->onDelete('cascade');

            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->integer('umur')->nullable();
            $table->text('alamat')->nullable();
            $table->date('tanggal_meninggal')->nullable();
            $table->string('hari')->nullable();
            $table->string('tempat_meninggal')->nullable();
            $table->string('penyebab')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kematians');
    }
};
