<?php

namespace App\Domain\ProfilDesa\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
    protected $table = 'perangkat_desa';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'urutan',
    ];
}
