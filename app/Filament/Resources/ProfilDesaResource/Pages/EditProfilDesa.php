<?php
namespace App\Filament\Resources\ProfilDesaResource\Pages;
use App\Filament\Resources\ProfilDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditProfilDesa extends EditRecord
{
    protected static string $resource = ProfilDesaResource::class;
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
