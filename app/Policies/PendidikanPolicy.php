<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pendidikan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PendidikanPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function view(User $user, Pendidikan $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function update(User $user, Pendidikan $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function delete(User $user, Pendidikan $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }
}
