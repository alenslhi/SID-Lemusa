<?php

namespace App\Domain\Pengaduan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = [
        'penduduk_id',
        'kategori_pengaduan_id',
        'judul',
        'isi_laporan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => \App\Domain\Pengaduan\Enums\StatusPengaduan::class,
        ];
    }

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Penduduk\Models\Penduduk::class);
    }

    public function kategoriPengaduan(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Pengaduan\Models\KategoriPengaduan::class);
    }

    public function lampiran(): HasMany
    {
        return $this->hasMany(\App\Domain\Pengaduan\Models\LampiranPengaduan::class);
    }
}
