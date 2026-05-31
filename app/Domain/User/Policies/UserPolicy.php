<?php

namespace App\Domain\User\Policies;

use App\Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_user');
    }

    public function view(User $user, User $model): bool
    {
        return $user->hasPermissionTo('lihat_user');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tambah_user');
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasPermissionTo('edit_user');
    }

    public function delete(User $user, User $model): bool
    {
        return $user->hasPermissionTo('hapus_user');
    }
}
