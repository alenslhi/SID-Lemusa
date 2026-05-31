<?php
namespace App\Filament\Resources\PengajuanSuratResource\Pages;
use App\Filament\Resources\PengajuanSuratResource;
use Filament\Resources\Pages\CreateRecord;
class CreatePengajuanSurat extends CreateRecord
{
    protected static string $resource = PengajuanSuratResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
