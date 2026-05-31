<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LampiranSurat extends Model
{
    public $timestamps = false;

    protected $table = 'lampiran_surat';

    protected $fillable = [
        'pengajuan_surat_id',
        'nama_file',
        'path_file',
        'ukuran_file',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function pengajuanSurat(): BelongsTo
    {
        return $this->belongsTo(PengajuanSurat::class);
    }
}
