<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProfilDesa;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilDesaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_profil_desa');
    }

    public function view(User $user, ProfilDesa $model): bool
    {
        return $user->hasPermissionTo('lihat_profil_desa');
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, ProfilDesa $model): bool
    {
        return $user->hasPermissionTo('edit_profil_desa');
    }

    public function delete(User $user, ProfilDesa $model): bool
    {
        return false;
    }
}
