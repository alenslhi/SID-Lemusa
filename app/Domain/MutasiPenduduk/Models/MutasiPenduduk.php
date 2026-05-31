<?php

namespace App\Domain\MutasiPenduduk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MutasiPenduduk extends Model
{
    public $timestamps = false;

    protected $table = 'mutasi_penduduk';

    protected $fillable = [
        'penduduk_id',
        'jenis_mutasi',
        'tanggal_mutasi',
        'keterangan',
        'dibuat_oleh',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mutasi' => 'date',
            'created_at' => 'datetime',
            'jenis_mutasi' => \App\Domain\MutasiPenduduk\Enums\JenisMutasi::class,
        ];
    }

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Penduduk\Models\Penduduk::class);
    }

    public function pembuatMutasi(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\User\Models\User::class, 'dibuat_oleh');
    }
}
