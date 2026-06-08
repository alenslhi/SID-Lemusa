<?php

namespace App\Policies;

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

    public function view(User $user, PengajuanSurat $surat): bool
    {
        return $user->hasPermissionTo('lihat_surat');
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Kepala Desa', 'Operator Desa', 'Warga']);
    }

    public function update(User $user, PengajuanSurat $surat): bool
    {
        return $user->hasPermissionTo('proses_surat');
    }

    public function delete(User $user, PengajuanSurat $surat): bool
    {
        return $user->hasPermissionTo('hapus_surat');
    }
}
