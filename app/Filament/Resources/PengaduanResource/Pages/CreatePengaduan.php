<?php
namespace App\Filament\Resources\PengaduanResource\Pages;
use App\Filament\Resources\PengaduanResource;
use Filament\Resources\Pages\CreateRecord;
class CreatePengaduan extends CreateRecord
{
    protected static string $resource = PengaduanResource::class;

    protected function beforeCreate(): void
    {
        $user = auth()->user();
        if ($user && $user->hasRole('Super Admin')) {
            return;
        }

        $userId = auth()->id();
        $key = 'rate_limit_pengaduan:' . $userId;

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 10)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);
            
            throw \Illuminate\Validation\ValidationException::withMessages([
                'judul' => "Anda telah mencapai batas pengaduan (10 per jam). Silakan coba lagi dalam {$minutes} menit.",
            ]);
        }

        \Illuminate\Support\Facades\RateLimiter::hit($key, 3600);
    }

    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
