<?php

namespace App\Domain\ActivityLog\Services;

use App\Domain\ActivityLog\Models\ActivityLog;

class ActivityLogger
{
    public static function log(string $aktivitas, ?int $userId = null): ActivityLog
    {
        return ActivityLog::create([
            'user_id' => $userId ?? auth()->id(),
            'aktivitas' => $aktivitas,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
