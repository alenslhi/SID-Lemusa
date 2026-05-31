<?php
namespace App\Filament\Resources\PengajuanSuratResource\Pages;
use App\Filament\Resources\PengajuanSuratResource;
use Filament\Resources\Pages\CreateRecord;
class CreatePengajuanSurat extends CreateRecord
{
    protected static string $resource = PengajuanSuratResource::class;

    protected function beforeCreate(): void
    {
        $user = auth()->user();
        if ($user && $user->hasRole('Super Admin')) {
            return;
        }

        $userId = auth()->id();
        $key = 'rate_limit_pengajuan_surat:' . $userId;

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 20)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);
            
            throw \Illuminate\Validation\ValidationException::withMessages([
                'jenis_surat_id' => "Anda telah mencapai batas pengajuan surat (20 per jam). Silakan coba lagi dalam {$minutes} menit.",
            ]);
        }

        \Illuminate\Support\Facades\RateLimiter::hit($key, 3600);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
