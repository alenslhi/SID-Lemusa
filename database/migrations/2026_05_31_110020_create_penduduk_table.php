<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('keluarga_id')->nullable()->constrained('keluarga')->cascadeOnDelete();
            $table->foreignId('dusun_id')->nullable()->constrained('dusun')->restrictOnDelete();
            $table->char('nik', 16)->unique();
            $table->string('nama_lengkap', 150);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->foreignId('agama_id')->constrained('agama')->restrictOnDelete();
            $table->foreignId('pendidikan_id')->constrained('pendidikan')->restrictOnDelete();
            $table->foreignId('pekerjaan_id')->constrained('pekerjaan')->restrictOnDelete();
            $table->foreignId('status_perkawinan_id')->constrained('status_perkawinan')->restrictOnDelete();
            $table->string('golongan_darah', 5)->nullable();
            $table->string('status_hubungan_dalam_keluarga', 50)->nullable();
            $table->string('kewarganegaraan', 10)->default('WNI');
            $table->string('no_paspor', 50)->nullable();
            $table->string('no_kitap', 50)->nullable();
            $table->string('nama_ayah', 150)->nullable();
            $table->string('nama_ibu', 150)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('foto', 255)->nullable();
            $table->enum('status_penduduk', ['aktif', 'meninggal', 'pindah_keluar'])->default('aktif');
            $table->timestamps();
        });

        Schema::table('keluarga', function (Blueprint $table) {
            $table->foreign('kepala_keluarga_id')->references('id')->on('penduduk')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('keluarga', function (Blueprint $table) {
            $table->dropForeign(['kepala_keluarga_id']);
        });
        Schema::dropIfExists('penduduk');
    }
};
