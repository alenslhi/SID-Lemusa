<?php

namespace App\Domain\MutasiPenduduk\DTOs;

use App\Domain\MutasiPenduduk\Enums\JenisMutasi;
use DateTimeInterface;

class RecordMutasiDTO
{
    public function __construct(
        public readonly int $pendudukId,
        public readonly JenisMutasi $jenisMutasi,
        public readonly DateTimeInterface $tanggalMutasi,
        public readonly ?string $keterangan,
        public readonly int $dibuatOleh
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            pendudukId: (int) $data['penduduk_id'],
            jenisMutasi: $data['jenis_mutasi'] instanceof JenisMutasi 
                ? $data['jenis_mutasi'] 
                : JenisMutasi::from($data['jenis_mutasi']),
            tanggalMutasi: $data['tanggal_mutasi'] instanceof DateTimeInterface 
                ? $data['tanggal_mutasi'] 
                : new \DateTime($data['tanggal_mutasi']),
            keterangan: $data['keterangan'] ?? null,
            dibuatOleh: (int) $data['dibuat_oleh']
        );
    }
}
