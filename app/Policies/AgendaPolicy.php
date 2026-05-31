<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agenda;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgendaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_agenda');
    }

    public function view(User $user, Agenda $model): bool
    {
        return $user->hasPermissionTo('lihat_agenda');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('tambah_agenda');
    }

    public function update(User $user, Agenda $model): bool
    {
        return $user->hasPermissionTo('edit_agenda');
    }

    public function delete(User $user, Agenda $model): bool
    {
        return $user->hasPermissionTo('hapus_agenda');
    }
}
