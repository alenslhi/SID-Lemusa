<?php

namespace App\Domain\ProfilDesa\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $table = 'profil_desa';

    protected $fillable = [
        'nama_desa',
        'sejarah',
        'visi',
        'misi',
        'alamat',
        'email',
        'telepon',
        'maps_embed',
        'sambutan_kepala_desa',
    ];
}
