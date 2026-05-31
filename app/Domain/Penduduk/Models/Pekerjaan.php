<?php

namespace App\Domain\Penduduk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pekerjaan extends Model
{
    public $timestamps = false;

    protected $table = 'pekerjaan';

    protected $fillable = ['nama'];

    public function penduduk(): HasMany
    {
        return $this->hasMany(\App\Domain\Penduduk\Models\Penduduk::class);
    }
}
