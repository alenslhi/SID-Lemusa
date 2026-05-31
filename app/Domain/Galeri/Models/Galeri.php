<?php

namespace App\Domain\Galeri\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'tipe',
        'judul',
        'file_url',
    ];

    protected function casts(): array
    {
        return [
            'tipe' => \App\Domain\Galeri\Enums\TipeGaleri::class,
        ];
    }
}
