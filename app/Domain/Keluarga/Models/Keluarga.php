<?php

namespace App\Domain\Keluarga\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Keluarga extends Model
{
    protected $table = 'keluarga';

    protected $fillable = [
        'nomor_kk',
        'dusun_id',
        'alamat',
        'rt',
        'rw',
    ];

    public function dusun(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Dusun\Models\Dusun::class);
    }

    public function penduduk(): HasMany
    {
        return $this->hasMany(\App\Domain\Penduduk\Models\Penduduk::class);
    }
}
