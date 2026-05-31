<?php

namespace App\Domain\Keluarga\Policies;

use App\Domain\User\Models\User;
use App\Domain\Keluarga\Models\Keluarga;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeluargaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_keluarga');
    }

    public function view(User $user, Keluarga $model): bool
    {
        return $user->hasPermissionTo('lihat_keluarga');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tambah_keluarga');
    }

    public function update(User $user, Keluarga $model): bool
    {
        return $user->hasPermissionTo('edit_keluarga');
    }

    public function delete(User $user, Keluarga $model): bool
    {
        return $user->hasPermissionTo('hapus_keluarga');
    }
}
