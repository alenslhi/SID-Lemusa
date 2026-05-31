<?php

namespace App\Domain\Surat\Policies;

use App\Domain\User\Models\User;
use App\Domain\Surat\Models\PengajuanSurat;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengajuanSuratPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_surat');
    }

    public function view(User $user, PengajuanSurat $model): bool
    {
        if ($user->hasPermissionTo('proses_surat')) {
            return true;
        }

        if ($user->hasPermissionTo('lihat_surat')) {
            // Warga can only view their own
            return $model->penduduk_id === $user->penduduk?->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('ajukan_surat') || $user->hasPermissionTo('proses_surat');
    }

    public function update(User $user, PengajuanSurat $model): bool
    {
        return $user->hasPermissionTo('proses_surat');
    }

    public function delete(User $user, PengajuanSurat $model): bool
    {
        return $user->hasPermissionTo('hapus_surat');
    }
}
