<?php

namespace App\Domain\Pengaduan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LampiranPengaduan extends Model
{
    public $timestamps = false;

    protected $table = 'lampiran_pengaduan';

    protected $fillable = [
        'pengaduan_id',
        'file',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Pengaduan\Models\Pengaduan::class);
    }
}
