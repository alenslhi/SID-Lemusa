<?php

namespace App\Domain\Dusun\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dusun extends Model
{
    protected $table = 'dusun';

    protected $fillable = ['nama', 'kepala_dusun'];

    public function keluarga(): HasMany
    {
        return $this->hasMany(\App\Domain\Keluarga\Models\Keluarga::class);
    }
}
