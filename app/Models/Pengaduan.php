<?php

namespace App\Models;

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

    public function penduduk(): BelongsTo
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function kategoriPengaduan(): BelongsTo
    {
        return $this->belongsTo(KategoriPengaduan::class);
    }

    public function lampiran(): HasMany
    {
        return $this->hasMany(LampiranPengaduan::class);
    }
}
