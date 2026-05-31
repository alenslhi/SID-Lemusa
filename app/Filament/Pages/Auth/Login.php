<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BasePage;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Domain\User\Models\User;
use App\Domain\ActivityLog\Services\ActivityLogger;

class Login extends BasePage
{
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();
        $email = $data['email'] ?? '';
        $ip = request()->ip();
        
        $minuteKey = 'login_attempts_minute:' . $ip;
        $lockoutKey = 'login_lockout_attempts:' . strtolower($email);

        // 1. Check if the account is locked out (10 failed attempts -> 15 min lock)
        if (RateLimiter::tooManyAttempts($lockoutKey, 10)) {
            $seconds = RateLimiter::availableIn($lockoutKey);
            $minutes = ceil($seconds / 60);
            
            ActivityLogger::log(
                aktivitas: "Gagal login (Akun dikunci sementara karena 10x gagal): {$email}",
                userId: null
            );

            throw ValidationException::withMessages([
                'email' => "Akun ini dikunci sementara karena 10 kali gagal login berturut-turut. Silakan coba lagi dalam {$minutes} menit.",
            ]);
        }

        // 2. Check if the IP is blocked (5 attempts -> 1 min block)
        if (RateLimiter::tooManyAttempts($minuteKey, 5)) {
            $seconds = RateLimiter::availableIn($minuteKey);
            
            ActivityLogger::log(
                aktivitas: "Gagal login (IP diblokir sementara karena 5x gagal dalam 1 menit): {$email}",
                userId: null
            );

            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik.",
            ]);
        }

        // Try authenticating
        try {
            $response = parent::authenticate();
            
            $user = auth()->user();
            if ($user && !$user->is_active) {
                auth()->logout();
                
                ActivityLogger::log(
                    aktivitas: "Gagal login (Akun dinonaktifkan): {$email}",
                    userId: null
                );
                
                throw ValidationException::withMessages([
                    'email' => 'Akun Anda dinonaktifkan. Silakan hubungi administrator.',
                ]);
            }
            
            // Clear attempts on success
            RateLimiter::clear($minuteKey);
            RateLimiter::clear($lockoutKey);

            return $response;

        } catch (ValidationException $e) {
            // Increment failed attempts
            RateLimiter::hit($minuteKey, 60); // block IP for 1 minute
            RateLimiter::hit($lockoutKey, 900); // block Account for 15 minutes (900 seconds)

            // Log failed attempt
            ActivityLogger::log(
                aktivitas: "Gagal login (Kredensial salah): {$email}",
                userId: null
            );

            throw $e;
        }
    }

    protected function getRememberFormComponent(): \Filament\Schemas\Components\Component
    {
        return \Filament\Forms\Components\Hidden::make('remember')->default(false);
    }
}
