<?php

namespace App\Filament\Resources\KeluargaResource\Pages;

use App\Filament\Resources\KeluargaResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListKeluarga extends ListRecords
{
    protected static string $resource = KeluargaResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
