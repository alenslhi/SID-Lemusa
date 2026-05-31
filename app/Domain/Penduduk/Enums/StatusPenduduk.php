<?php

namespace App\Domain\Penduduk\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusPenduduk: string implements HasLabel, HasColor
{
    case AKTIF = 'aktif';
    case MENINGGAL = 'meninggal';
    case PINDAH_KELUAR = 'pindah_keluar';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::AKTIF => 'Aktif',
            self::MENINGGAL => 'Meninggal',
            self::PINDAH_KELUAR => 'Pindah Keluar',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::AKTIF => 'success',
            self::MENINGGAL => 'danger',
            self::PINDAH_KELUAR => 'warning',
        };
    }
}
