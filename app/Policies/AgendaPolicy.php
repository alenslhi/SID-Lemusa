<?php

namespace App\Policies;

use App\Domain\User\Models\User;
use App\Domain\Agenda\Models\Agenda;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgendaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) { return $user->hasPermissionTo('lihat_agenda'); }
    public function view(User $user, Agenda $model) { return $user->hasPermissionTo('lihat_agenda'); }
    public function create(User $user) { return $user->hasPermissionTo('tambah_agenda'); }
    public function update(User $user, Agenda $model) { return $user->hasPermissionTo('edit_agenda'); }
    public function delete(User $user, Agenda $model) { return $user->hasPermissionTo('hapus_agenda'); }
}
