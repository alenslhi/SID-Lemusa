<?php

namespace App\Domain\Pengaduan\Enums;




enum StatusPengaduan: string
{
    case BARU = 'baru';
    case DIPROSES = 'diproses';
    case SELESAI = 'selesai';
    case DITOLAK = 'ditolak';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::BARU => 'Baru',
            self::DIPROSES => 'Diproses',
            self::SELESAI => 'Selesai',
            self::DITOLAK => 'Ditolak',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::BARU => 'warning',
            self::DIPROSES => 'info',
            self::SELESAI => 'success',
            self::DITOLAK => 'danger',
        };
    }
}
