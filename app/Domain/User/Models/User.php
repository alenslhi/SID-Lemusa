<?php

namespace App\Domain\User\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'is_active' => 'boolean',
            'password' => 'hashed',
        ];
    }



    // ─── Relationships ─────────────────────────────────────

    public function penduduk(): HasOne
    {
        return $this->hasOne(\App\Domain\Penduduk\Models\Penduduk::class);
    }

    public function berita(): HasMany
    {
        return $this->hasMany(\App\Domain\Berita\Models\Berita::class, 'published_by');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(\App\Domain\Notification\Models\Notification::class);
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(\App\Domain\ActivityLog\Models\ActivityLog::class);
    }
}
