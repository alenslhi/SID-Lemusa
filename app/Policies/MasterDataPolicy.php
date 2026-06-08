<?php

namespace App\Policies;

use App\Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MasterDataPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool { return $user->hasPermissionTo('kelola_master_data'); }
    public function view(User $user, $model): bool { return $user->hasPermissionTo('kelola_master_data'); }
    public function create(User $user): bool { return $user->hasPermissionTo('kelola_master_data'); }
    public function update(User $user, $model): bool { return $user->hasPermissionTo('kelola_master_data'); }
    public function delete(User $user, $model): bool { return $user->hasRole('Super Admin'); }
}
