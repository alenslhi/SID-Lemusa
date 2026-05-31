<?php

namespace App\Domain\PotensiDesa\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPotensi extends Model
{
    public $timestamps = false;

    protected $table = 'kategori_potensi';

    protected $fillable = ['nama'];

    public function potensiDesa(): HasMany
    {
        return $this->hasMany(\App\Domain\PotensiDesa\Models\PotensiDesa::class);
    }
}
