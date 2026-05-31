<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DusunResource\Pages;
use App\Models\Dusun;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DusunResource extends Resource
{
    protected static ?string $model = Dusun::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-map-pin';

    protected static string | \UnitEnum | null $navigationGroup = 'Kependudukan';

    protected static ?string $navigationLabel = 'Dusun';

    protected static ?string $modelLabel = 'Dusun';

    protected static ?string $pluralModelLabel = 'Dusun';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('kepala_dusun')
                    ->label('Kepala Dusun')
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kepala_dusun')
                    ->label('Kepala Dusun')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keluarga_count')
                    ->label('Jumlah KK')
                    ->counts('keluarga')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ManageDusun::route('/'),
        ];
    }
}
