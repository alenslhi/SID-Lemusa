<?php

namespace App\Domain\Galeri\Enums;




enum TipeGaleri: string
{
    case FOTO = 'foto';
    case VIDEO = 'video';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FOTO => 'Foto',
            self::VIDEO => 'Video',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::FOTO => 'success',
            self::VIDEO => 'info',
        };
    }
}
