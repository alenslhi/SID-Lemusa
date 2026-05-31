<?php

namespace App\Filament\Resources\PekerjaanResource\Pages;

use App\Filament\Resources\PekerjaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePekerjaan extends ManageRecords
{
    protected static string $resource = PekerjaanResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
