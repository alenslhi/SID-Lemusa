<?php

namespace App\Domain\MutasiPenduduk\Actions;

use App\Domain\MutasiPenduduk\DTOs\RecordMutasiDTO;
use App\Domain\MutasiPenduduk\Enums\JenisMutasi;
use App\Domain\MutasiPenduduk\Models\MutasiPenduduk;
use App\Domain\Penduduk\Models\Penduduk;
use App\Domain\Penduduk\Enums\StatusPenduduk;
use App\Domain\ActivityLog\Services\ActivityLogger;
use Illuminate\Support\Facades\DB;

class RecordMutasiPendudukAction
{
    public function execute(RecordMutasiDTO $dto): MutasiPenduduk
    {
        return DB::transaction(function () use ($dto) {
            // 1. Create MutasiPenduduk record
            $mutasi = MutasiPenduduk::create([
                'penduduk_id' => $dto->pendudukId,
                'jenis_mutasi' => $dto->jenisMutasi,
                'tanggal_mutasi' => $dto->tanggalMutasi,
                'keterangan' => $dto->keterangan,
                'dibuat_oleh' => $dto->dibuatOleh,
            ]);

            // 2. Update Penduduk status if applicable
            $penduduk = Penduduk::findOrFail($dto->pendudukId);

            if ($dto->jenisMutasi === JenisMutasi::MENINGGAL) {
                $penduduk->update(['status_penduduk' => StatusPenduduk::MENINGGAL]);
            } elseif ($dto->jenisMutasi === JenisMutasi::PINDAH_KELUAR) {
                $penduduk->update(['status_penduduk' => StatusPenduduk::PINDAH_KELUAR]);
            }

            // 3. Log Activity
            ActivityLogger::log(
                aktivitas: "Mencatat mutasi penduduk: {$penduduk->nama_lengkap} ({$dto->jenisMutasi->getLabel()})",
                userId: $dto->dibuatOleh
            );

            return $mutasi;
        });
    }
}
