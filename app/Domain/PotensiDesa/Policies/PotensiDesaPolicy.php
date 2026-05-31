<?php

namespace App\Domain\PotensiDesa\Policies;

use App\Domain\User\Models\User;
use App\Domain\PotensiDesa\Models\PotensiDesa;
use Illuminate\Auth\Access\HandlesAuthorization;

class PotensiDesaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_potensi');
    }

    public function view(User $user, PotensiDesa $model): bool
    {
        return $user->hasPermissionTo('lihat_potensi');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tambah_potensi');
    }

    public function update(User $user, PotensiDesa $model): bool
    {
        return $user->hasPermissionTo('edit_potensi');
    }

    public function delete(User $user, PotensiDesa $model): bool
    {
        return $user->hasPermissionTo('hapus_potensi');
    }
}
