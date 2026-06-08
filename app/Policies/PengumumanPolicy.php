<?php

namespace App\Policies;

use App\Domain\User\Models\User;
use App\Domain\Pengumuman\Models\Pengumuman;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengumumanPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) { return $user->hasPermissionTo('lihat_pengumuman'); }
    public function view(User $user, Pengumuman $model) { return $user->hasPermissionTo('lihat_pengumuman'); }
    public function create(User $user) { return $user->hasPermissionTo('tambah_pengumuman'); }
    public function update(User $user, Pengumuman $model) { return $user->hasPermissionTo('edit_pengumuman'); }
    public function delete(User $user, Pengumuman $model) { return $user->hasPermissionTo('hapus_pengumuman'); }
}
