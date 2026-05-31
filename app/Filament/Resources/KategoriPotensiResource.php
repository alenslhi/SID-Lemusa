<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriPotensiResource\Pages;
use App\Domain\PotensiDesa\Models\KategoriPotensi;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KategoriPotensiResource extends Resource
{
    protected static ?string $model = KategoriPotensi::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Kategori Potensi';
    protected static ?string $modelLabel = 'Kategori Potensi';
    protected static ?string $pluralModelLabel = 'Kategori Potensi';
    protected static ?int $navigationSort = 5;

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')->required()->maxLength(100)->unique(ignoreRecord: true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('potensi_desa_count')
                    ->label('Jumlah Potensi')
                    ->counts('potensiDesa')
                    ->sortable(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([\Filament\Actions\BulkActionGroup::make([\Filament\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageKategoriPotensi::route('/')];
    }
}
