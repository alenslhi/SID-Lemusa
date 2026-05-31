<?php

namespace App\Filament\Resources\MutasiPendudukResource\Pages;

use App\Filament\Resources\MutasiPendudukResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateMutasiPenduduk extends CreateRecord
{
    protected static string $resource = MutasiPendudukResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['dibuat_oleh'] = auth()->id();
        
        $dto = \App\Domain\MutasiPenduduk\DTOs\RecordMutasiDTO::fromArray($data);
        $action = new \App\Domain\MutasiPenduduk\Actions\RecordMutasiPendudukAction();
        
        return $action->execute($dto);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
