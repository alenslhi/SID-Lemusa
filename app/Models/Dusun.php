<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dusun extends Model
{
    protected $table = 'dusun';

    protected $fillable = ['nama', 'kepala_dusun'];

    public function keluarga(): HasMany
    {
        return $this->hasMany(Keluarga::class);
    }
}
