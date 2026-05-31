<?php
namespace App\Filament\Resources\PerangkatDesaResource\Pages;
use App\Filament\Resources\PerangkatDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
class ManagePerangkatDesa extends ManageRecords
{
    protected static string $resource = PerangkatDesaResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}
