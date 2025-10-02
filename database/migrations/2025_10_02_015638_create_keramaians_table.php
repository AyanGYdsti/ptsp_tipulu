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
        Schema::create('keramaians', function (Blueprint $table) {
            $table->id();

            // Relasi ke pengajuan
            $table->foreignId('pengajuan_id')
                  ->constrained('pengajuans')
                  ->onDelete('cascade');

            // Data dinamis keramaian
            $table->string('nama_acara');              // contoh: Pernikahan, Konser, Festival, dll
            $table->string('penyelenggara')->nullable(); // bisa nama komunitas/individu
            $table->text('deskripsi_acara')->nullable(); // deskripsi konteks acara
            $table->date('tanggal');                   // tanggal acara
            $table->string('tempat');                  // lokasi acara
            $table->string('pukul')->nullable();       // jam acara (opsional)

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keramaians');
    }
};
