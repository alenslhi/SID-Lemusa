<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatusPerkawinanResource\Pages;
use App\Models\StatusPerkawinan;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StatusPerkawinanResource extends Resource
{
    protected static ?string $model = StatusPerkawinan::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-heart';

    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Status Perkawinan';

    protected static ?string $modelLabel = 'Status Perkawinan';

    protected static ?string $pluralModelLabel = 'Status Perkawinan';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('No')->sortable(),
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('penduduk_count')
                    ->label('Jumlah Penduduk')
                    ->counts('penduduk')
                    ->sortable(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageStatusPerkawinan::route('/'),
        ];
    }
}
