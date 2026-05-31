<?php

namespace App\Domain\Penduduk\Policies;

use App\Domain\User\Models\User;
use App\Domain\Penduduk\Models\Pekerjaan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PekerjaanPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function view(User $user, Pekerjaan $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function update(User $user, Pekerjaan $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function delete(User $user, Pekerjaan $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }
}
