<?php

namespace App\Policies;

use App\Domain\User\Models\User;
use App\Domain\Penduduk\Models\Penduduk;
use Illuminate\Auth\Access\HandlesAuthorization;

class PendudukPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_penduduk');
    }

    public function view(User $user, Penduduk $penduduk): bool
    {
        return $user->hasPermissionTo('lihat_penduduk');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tambah_penduduk');
    }

    public function update(User $user, Penduduk $penduduk): bool
    {
        return $user->hasPermissionTo('edit_penduduk');
    }

    public function delete(User $user, Penduduk $penduduk): bool
    {
        return $user->hasPermissionTo('hapus_penduduk');
    }
}
