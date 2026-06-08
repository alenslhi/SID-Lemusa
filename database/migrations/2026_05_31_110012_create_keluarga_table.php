<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keluarga', function (Blueprint $table) {
            $table->id();
            $table->char('nomor_kk', 16)->unique();
            $table->unsignedBigInteger('kepala_keluarga_id')->nullable();
            $table->foreignId('dusun_id')->constrained('dusun')->cascadeOnDelete();
            $table->text('alamat');
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keluarga');
    }
};
