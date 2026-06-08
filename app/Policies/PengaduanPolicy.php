<?php

namespace App\Policies;

use App\Domain\User\Models\User;
use App\Domain\Pengaduan\Models\Pengaduan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengaduanPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_pengaduan');
    }

    public function view(User $user, Pengaduan $pengaduan): bool
    {
        return $user->hasPermissionTo('lihat_pengaduan');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('ajukan_pengaduan');
    }

    public function update(User $user, Pengaduan $pengaduan): bool
    {
        return $user->hasPermissionTo('proses_pengaduan');
    }

    public function delete(User $user, Pengaduan $pengaduan): bool
    {
        return $user->hasPermissionTo('hapus_pengaduan');
    }
}
