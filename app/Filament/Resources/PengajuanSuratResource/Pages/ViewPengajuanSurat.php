<?php
namespace App\Filament\Resources\PengajuanSuratResource\Pages;
use App\Filament\Resources\PengajuanSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
class ViewPengajuanSurat extends ViewRecord
{
    protected static string $resource = PengajuanSuratResource::class;
    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
