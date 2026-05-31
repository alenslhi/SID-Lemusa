<?php

namespace App\Domain\Surat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PengajuanSurat extends Model
{
    protected $table = 'pengajuan_surat';

    protected $fillable = [
        'kode_pengajuan',
        'penduduk_id',
        'jenis_surat_id',
        'status_surat_id',
        'estimasi_selesai',
        'catatan_admin',
        'diproses_oleh',
    ];

    protected function casts(): array
    {
        return [
            'estimasi_selesai' => 'datetime',
        ];
    }

    // ─── Relationships ─────────────────────────────────────

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Penduduk\Models\Penduduk::class);
    }

    public function jenisSurat(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Surat\Models\JenisSurat::class);
    }

    public function statusSurat(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Surat\Models\StatusSurat::class);
    }

    public function prosesOleh(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\User\Models\User::class, 'diproses_oleh');
    }

    public function lampiran(): HasMany
    {
        return $this->hasMany(\App\Domain\Surat\Models\LampiranSurat::class);
    }

    public function suratHasil(): HasOne
    {
        return $this->hasOne(\App\Domain\Surat\Models\SuratHasil::class);
    }

    public function riwayatStatus(): HasMany
    {
        return $this->hasMany(\App\Domain\Surat\Models\RiwayatStatusSurat::class);
    }
}
