<?php

namespace App\Domain\Penduduk\Enums;




enum JenisKelamin: string
{
    case LAKI_LAKI = 'L';
    case PEREMPUAN = 'P';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::LAKI_LAKI => 'Laki-laki',
            self::PEREMPUAN => 'Perempuan',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::LAKI_LAKI => 'info',
            self::PEREMPUAN => 'danger',
        };
    }
}
