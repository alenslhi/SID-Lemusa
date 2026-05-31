<?php

namespace App\Domain\ProfilDesa\Policies;

use App\Domain\User\Models\User;
use App\Domain\ProfilDesa\Models\PerangkatDesa;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerangkatDesaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_perangkat_desa');
    }

    public function view(User $user, PerangkatDesa $model): bool
    {
        return $user->hasPermissionTo('lihat_perangkat_desa');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tambah_perangkat_desa');
    }

    public function update(User $user, PerangkatDesa $model): bool
    {
        return $user->hasPermissionTo('edit_perangkat_desa');
    }

    public function delete(User $user, PerangkatDesa $model): bool
    {
        return $user->hasPermissionTo('hapus_perangkat_desa');
    }
}
