<?php

namespace App\Filament\Resources\MutasiPendudukResource\Pages;

use App\Filament\Resources\MutasiPendudukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMutasiPenduduk extends ListRecords
{
    protected static string $resource = MutasiPendudukResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
