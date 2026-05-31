<?php

namespace App\Domain\PotensiDesa\Policies;

use App\Domain\User\Models\User;
use App\Domain\PotensiDesa\Models\KategoriPotensi;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategoriPotensiPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_potensi') || $user->hasPermissionTo('kelola_master_data');
    }

    public function view(User $user, KategoriPotensi $model): bool
    {
        return $user->hasPermissionTo('lihat_potensi') || $user->hasPermissionTo('kelola_master_data');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function update(User $user, KategoriPotensi $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function delete(User $user, KategoriPotensi $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }
}
