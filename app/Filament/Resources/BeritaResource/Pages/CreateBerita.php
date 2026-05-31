<?php
namespace App\Filament\Resources\BeritaResource\Pages;
use App\Filament\Resources\BeritaResource;
use Filament\Resources\Pages\CreateRecord;
class CreateBerita extends CreateRecord
{
    protected static string $resource = BeritaResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['published_by'] = auth()->id();
        return $data;
    }
    protected function getRedirectUrl(): string { return $this->getResource()::getUrl('index'); }
}
