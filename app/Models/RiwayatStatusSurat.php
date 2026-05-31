<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatStatusSurat extends Model
{
    public $timestamps = false;

    protected $table = 'riwayat_status_surat';

    protected $fillable = [
        'pengajuan_surat_id',
        'status_surat_id',
        'catatan',
        'user_id',
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

    public function statusSurat(): BelongsTo
    {
        return $this->belongsTo(StatusSurat::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
