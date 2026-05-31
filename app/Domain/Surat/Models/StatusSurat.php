<?php

namespace App\Domain\Surat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusSurat extends Model
{
    public $timestamps = false;

    protected $table = 'status_surat';

    protected $fillable = ['nama'];

    public function pengajuanSurat(): HasMany
    {
        return $this->hasMany(\App\Domain\Surat\Models\PengajuanSurat::class);
    }

    public function riwayatStatusSurat(): HasMany
    {
        return $this->hasMany(\App\Domain\Surat\Models\RiwayatStatusSurat::class);
    }
}
