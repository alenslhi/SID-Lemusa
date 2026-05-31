<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pengumuman;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengumumanPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_pengumuman');
    }

    public function view(User $user, Pengumuman $model): bool
    {
        return $user->hasPermissionTo('lihat_pengumuman');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tambah_pengumuman');
    }

    public function update(User $user, Pengumuman $model): bool
    {
        return $user->hasPermissionTo('edit_pengumuman');
    }

    public function delete(User $user, Pengumuman $model): bool
    {
        return $user->hasPermissionTo('hapus_pengumuman');
    }
}
