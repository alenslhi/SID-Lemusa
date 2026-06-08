<?php

namespace App\Domain\MutasiPenduduk\Enums;




enum JenisMutasi: string
{
    case LAHIR = 'lahir';
    case MENINGGAL = 'meninggal';
    case PINDAH_MASUK = 'pindah_masuk';
    case PINDAH_KELUAR = 'pindah_keluar';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::LAHIR => 'Lahir',
            self::MENINGGAL => 'Meninggal',
            self::PINDAH_MASUK => 'Pindah Masuk',
            self::PINDAH_KELUAR => 'Pindah Keluar',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::LAHIR => 'success',
            self::MENINGGAL => 'danger',
            self::PINDAH_MASUK => 'info',
            self::PINDAH_KELUAR => 'warning',
        };
    }
}
