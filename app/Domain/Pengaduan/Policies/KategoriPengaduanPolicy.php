<?php

namespace App\Domain\Pengaduan\Policies;

use App\Domain\User\Models\User;
use App\Domain\Pengaduan\Models\KategoriPengaduan;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategoriPengaduanPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_pengaduan') || $user->hasPermissionTo('kelola_master_data');
    }

    public function view(User $user, KategoriPengaduan $model): bool
    {
        return $user->hasPermissionTo('lihat_pengaduan') || $user->hasPermissionTo('kelola_master_data');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function update(User $user, KategoriPengaduan $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function delete(User $user, KategoriPengaduan $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }
}
