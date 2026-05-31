<?php

namespace App\Domain\Pengaduan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPengaduan extends Model
{
    public $timestamps = false;

    protected $table = 'kategori_pengaduan';

    protected $fillable = ['nama'];

    public function pengaduan(): HasMany
    {
        return $this->hasMany(\App\Domain\Pengaduan\Models\Pengaduan::class);
    }
}
