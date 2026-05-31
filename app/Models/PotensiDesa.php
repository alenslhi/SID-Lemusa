<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PotensiDesa extends Model
{
    protected $table = 'potensi_desa';

    protected $fillable = [
        'kategori_potensi_id',
        'nama',
        'deskripsi',
        'foto',
    ];

    public function kategoriPotensi(): BelongsTo
    {
        return $this->belongsTo(KategoriPotensi::class);
    }
}
