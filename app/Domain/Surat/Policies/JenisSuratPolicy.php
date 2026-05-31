<?php

namespace App\Domain\Surat\Policies;

use App\Domain\User\Models\User;
use App\Domain\Surat\Models\JenisSurat;
use Illuminate\Auth\Access\HandlesAuthorization;

class JenisSuratPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_surat') || $user->hasPermissionTo('kelola_master_data');
    }

    public function view(User $user, JenisSurat $model): bool
    {
        return $user->hasPermissionTo('lihat_surat') || $user->hasPermissionTo('kelola_master_data');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function update(User $user, JenisSurat $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }

    public function delete(User $user, JenisSurat $model): bool
    {
        return $user->hasPermissionTo('kelola_master_data');
    }
}
