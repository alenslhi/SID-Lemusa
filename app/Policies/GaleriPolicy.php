<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Galeri;
use Illuminate\Auth\Access\HandlesAuthorization;

class GaleriPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_galeri');
    }

    public function view(User $user, Galeri $model): bool
    {
        return $user->hasPermissionTo('lihat_galeri');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tambah_galeri');
    }

    public function update(User $user, Galeri $model): bool
    {
        return $user->hasPermissionTo('edit_galeri');
    }

    public function delete(User $user, Galeri $model): bool
    {
        return $user->hasPermissionTo('hapus_galeri');
    }
}
