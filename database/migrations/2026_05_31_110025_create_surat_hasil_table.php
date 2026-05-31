<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_hasil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_surat_id')->unique()->constrained('pengajuan_surat')->cascadeOnDelete();
            $table->string('nomor_surat', 100);
            $table->string('file_pdf', 255);
            $table->foreignId('uploaded_by')->constrained('users')->restrictOnDelete();
            $table->timestamp('uploaded_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_hasil');
    }
};
