<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fcm_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('token', 500); 
            $table->timestamps();
            
            $table->unique(['user_id', 'token']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fcm_tokens');
    }
};