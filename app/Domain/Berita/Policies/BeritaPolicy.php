<?php

namespace App\Domain\Berita\Policies;

use App\Domain\User\Models\User;
use App\Domain\Berita\Models\Berita;
use Illuminate\Auth\Access\HandlesAuthorization;

class BeritaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_berita');
    }

    public function view(User $user, Berita $model): bool
    {
        return $user->hasPermissionTo('lihat_berita');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tambah_berita');
    }

    public function update(User $user, Berita $model): bool
    {
        return $user->hasPermissionTo('edit_berita');
    }

    public function delete(User $user, Berita $model): bool
    {
        return $user->hasPermissionTo('hapus_berita');
    }
}
