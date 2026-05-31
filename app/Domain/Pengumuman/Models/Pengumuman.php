<?php

namespace App\Domain\Pengumuman\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'isi',
        'mulai_tampil',
        'selesai_tampil',
    ];

    protected function casts(): array
    {
        return [
            'mulai_tampil' => 'date',
            'selesai_tampil' => 'date',
        ];
    }

    /**
     * Scope to get only currently active announcements.
     */
    public function scopeAktif($query)
    {
        return $query->where('mulai_tampil', '<=', now())
                     ->where('selesai_tampil', '>=', now());
    }
}
