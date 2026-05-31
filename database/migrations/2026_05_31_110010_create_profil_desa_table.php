<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa', 255);
            $table->longText('sejarah')->nullable();
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('telepon', 50)->nullable();
            $table->longText('maps_embed')->nullable();
            $table->longText('sambutan_kepala_desa')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_desa');
    }
};
