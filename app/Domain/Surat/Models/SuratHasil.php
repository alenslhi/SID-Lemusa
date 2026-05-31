<?php

namespace App\Domain\Surat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratHasil extends Model
{
    protected static function booted(): void
    {
        static::created(function ($model) {
            $kode = $model->pengajuanSurat?->kode_pengajuan ?? 'Unknown';
            \App\Domain\ActivityLog\Services\ActivityLogger::log(
                "Mengunggah surat hasil untuk pengajuan: {$kode} (Nomor: {$model->nomor_surat})"
            );
        });
    }

    public $timestamps = false;

    protected $table = 'surat_hasil';

    protected $fillable = [
        'pengajuan_surat_id',
        'nomor_surat',
        'file_pdf',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'uploaded_at' => 'datetime',
        ];
    }

    public function pengajuanSurat(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Surat\Models\PengajuanSurat::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\User\Models\User::class, 'uploaded_by');
    }
}
