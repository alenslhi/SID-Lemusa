<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPotensi extends Model
{
    public $timestamps = false;

    protected $table = 'kategori_potensi';

    protected $fillable = ['nama'];

    public function potensiDesa(): HasMany
    {
        return $this->hasMany(PotensiDesa::class);
    }
}
