<?php

namespace App\Domain\Surat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisSurat extends Model
{
    public $timestamps = false;

    protected $table = 'jenis_surat';

    protected $fillable = ['nama', 'deskripsi'];

    public function pengajuanSurat(): HasMany
    {
        return $this->hasMany(\App\Domain\Surat\Models\PengajuanSurat::class);
    }
}
