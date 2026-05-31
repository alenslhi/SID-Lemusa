<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Custom policy guesser for Domain Driven namespaces
        Gate::guessPolicyNamesUsing(function (string $modelClass) {
            $policyClass = str_replace('\\Models\\', '\\Policies\\', $modelClass) . 'Policy';
            if (class_exists($policyClass)) {
                return $policyClass;
            }
            return 'App\\Policies\\' . class_basename($modelClass) . 'Policy';
        });

        // Force HTTPS in production
        if (app()->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Super Admin bypasses all permission checks
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        // Register Auth Event Listeners for logging
        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            \App\Domain\ActivityLog\Services\ActivityLogger::log(
                aktivitas: "Berhasil login ke sistem",
                userId: $event->user->id
            );
            $event->user->update(['last_login_at' => now()]);
        });

        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Logout::class, function ($event) {
            if ($event->user) {
                \App\Domain\ActivityLog\Services\ActivityLogger::log(
                    aktivitas: "Logout dari sistem",
                    userId: $event->user->id
                );
            }
        });
    }
}
