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
        Schema::create('tempat_tinggal_sementaras', function (Blueprint $table) {
            $table->id();
            // Kolom ini akan menghubungkan ke tabel 'pengajuans'
            $table->foreignId('pengajuan_id')->constrained()->onDelete('cascade');

            // Tambahkan kolom lain yang relevan untuk surat ini
            $table->string('alamat_sementara');
            $table->string('nik');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->integer('RT');
            $table->integer('RW');
            $table->date('tgl_lahir');
            $table->string('tempat_lahir');
            $table->string('agama');
            $table->string('status');
            $table->string('pekerjaan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_tinggal_sementaras');
    }
};
