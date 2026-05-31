<?php

namespace App\Domain\ActivityLog\Policies;

use App\Domain\User\Models\User;
use App\Domain\ActivityLog\Models\ActivityLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityLogPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('lihat_activity_log');
    }

    public function view(User $user, ActivityLog $model): bool
    {
        return $user->hasPermissionTo('lihat_activity_log');
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, ActivityLog $model): bool
    {
        return false;
    }

    public function delete(User $user, ActivityLog $model): bool
    {
        return false;
    }
}
