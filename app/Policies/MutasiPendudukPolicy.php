<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MutasiPenduduk;
use Illuminate\Auth\Access\HandlesAuthorization;

class MutasiPendudukPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_mutasi');
    }

    public function view(User $user, MutasiPenduduk $model): bool
    {
        return $user->hasPermissionTo('lihat_mutasi');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tambah_mutasi');
    }

    public function update(User $user, MutasiPenduduk $model): bool
    {
        return false;
    }

    public function delete(User $user, MutasiPenduduk $model): bool
    {
        return false;
    }
}
