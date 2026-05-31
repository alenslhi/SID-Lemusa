<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusPerkawinan extends Model
{
    public $timestamps = false;

    protected $table = 'status_perkawinan';

    protected $fillable = ['nama'];

    public function penduduk(): HasMany
    {
        return $this->hasMany(Penduduk::class);
    }
}
