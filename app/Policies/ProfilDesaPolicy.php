<?php

namespace App\Policies;

use App\Domain\User\Models\User;
use App\Domain\ProfilDesa\Models\ProfilDesa;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilDesaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) { return $user->hasPermissionTo('lihat_profil_desa'); }
    public function view(User $user, ProfilDesa $model) { return $user->hasPermissionTo('lihat_profil_desa'); }
    public function create(User $user) { return false; } // Handled via SEEDER usually
    public function update(User $user, ProfilDesa $model) { return $user->hasPermissionTo('edit_profil_desa'); }
    public function delete(User $user, ProfilDesa $model) { return false; }
}
