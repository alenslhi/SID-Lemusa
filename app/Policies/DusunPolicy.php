<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Dusun;
use Illuminate\Auth\Access\HandlesAuthorization;

class DusunPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_dusun');
    }

    public function view(User $user, Dusun $model): bool
    {
        return $user->hasPermissionTo('lihat_dusun');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tambah_dusun');
    }

    public function update(User $user, Dusun $model): bool
    {
        return $user->hasPermissionTo('edit_dusun');
    }

    public function delete(User $user, Dusun $model): bool
    {
        return $user->hasPermissionTo('hapus_dusun');
    }
}
