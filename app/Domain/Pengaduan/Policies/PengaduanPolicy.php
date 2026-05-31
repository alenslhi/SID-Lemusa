<?php

namespace App\Domain\Pengaduan\Policies;

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

    public function view(User $user, Pengaduan $model): bool
    {
        if ($user->hasPermissionTo('proses_pengaduan')) {
            return true;
        }

        if ($user->hasPermissionTo('lihat_pengaduan')) {
            // Warga can only view their own
            return $model->penduduk_id === $user->penduduk?->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('ajukan_pengaduan') || $user->hasPermissionTo('proses_pengaduan');
    }

    public function update(User $user, Pengaduan $model): bool
    {
        // Operator can process, Warga cannot edit after submission
        return $user->hasPermissionTo('proses_pengaduan');
    }

    public function delete(User $user, Pengaduan $model): bool
    {
        return $user->hasPermissionTo('hapus_pengaduan');
    }
}
