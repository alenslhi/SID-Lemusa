<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penduduk extends Model
{
    protected $table = 'penduduk';

    protected $fillable = [
        'user_id',
        'keluarga_id',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama_id',
        'pendidikan_id',
        'pekerjaan_id',
        'status_perkawinan_id',
        'no_hp',
        'email',
        'foto',
        'status_penduduk',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    // ─── Relationships ─────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(Keluarga::class);
    }

    public function agama(): BelongsTo
    {
        return $this->belongsTo(Agama::class);
    }

    public function pendidikan(): BelongsTo
    {
        return $this->belongsTo(Pendidikan::class);
    }

    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class);
    }

    public function statusPerkawinan(): BelongsTo
    {
        return $this->belongsTo(StatusPerkawinan::class);
    }

    public function mutasi(): HasMany
    {
        return $this->hasMany(MutasiPenduduk::class);
    }

    public function pengajuanSurat(): HasMany
    {
        return $this->hasMany(PengajuanSurat::class);
    }

    public function pengaduan(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }
}
