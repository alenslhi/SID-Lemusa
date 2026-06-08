<?php

namespace App\Policies;

use App\Domain\User\Models\User;
use App\Domain\MutasiPenduduk\Models\MutasiPenduduk;
use Illuminate\Auth\Access\HandlesAuthorization;

class MutasiPendudukPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool { return $user->hasPermissionTo('lihat_mutasi'); }
    public function view(User $user, MutasiPenduduk $model): bool { return $user->hasPermissionTo('lihat_mutasi'); }
    public function create(User $user): bool { return $user->hasPermissionTo('tambah_mutasi'); }
    public function update(User $user, MutasiPenduduk $model): bool { return $user->hasPermissionTo('tambah_mutasi'); }
    public function delete(User $user, MutasiPenduduk $model): bool { return $user->hasRole('Super Admin'); }
}
