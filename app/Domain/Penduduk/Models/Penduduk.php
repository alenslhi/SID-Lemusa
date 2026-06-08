<?php

namespace App\Domain\Penduduk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penduduk extends Model
{
    protected static function booted(): void
    {
        static::deleted(function ($model) {
            \App\Domain\ActivityLog\Services\ActivityLogger::log(
                "Menghapus data penduduk: {$model->nama_lengkap}"
            );
        });
    }

    protected $table = 'penduduk';

    protected $fillable = [
        'user_id',
        'keluarga_id',
        'dusun_id',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama_id',
        'pendidikan_id',
        'pekerjaan_id',
        'status_perkawinan_id',
        'golongan_darah',
        'status_hubungan_dalam_keluarga',
        'kewarganegaraan',
        'no_paspor',
        'no_kitap',
        'nama_ayah',
        'nama_ibu',
        'no_hp',
        'email',
        'foto',
        'status_penduduk',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'jenis_kelamin' => \App\Domain\Penduduk\Enums\JenisKelamin::class,
            'status_penduduk' => \App\Domain\Penduduk\Enums\StatusPenduduk::class,
        ];
    }

    // ─── Relationships ─────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\User\Models\User::class);
    }

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Keluarga\Models\Keluarga::class);
    }

    public function dusun(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Dusun\Models\Dusun::class);
    }

    public function agama(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Penduduk\Models\Agama::class);
    }

    public function pendidikan(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Penduduk\Models\Pendidikan::class);
    }

    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Penduduk\Models\Pekerjaan::class);
    }

    public function statusPerkawinan(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Penduduk\Models\StatusPerkawinan::class);
    }

    public function mutasi(): HasMany
    {
        return $this->hasMany(\App\Domain\MutasiPenduduk\Models\MutasiPenduduk::class);
    }

    public function pengajuanSurat(): HasMany
    {
        return $this->hasMany(\App\Domain\Surat\Models\PengajuanSurat::class);
    }

    public function pengaduan(): HasMany
    {
        return $this->hasMany(\App\Domain\Pengaduan\Models\Pengaduan::class);
    }
}
