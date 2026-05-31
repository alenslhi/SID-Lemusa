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

        // Super Admin bypasses all permission checks
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
