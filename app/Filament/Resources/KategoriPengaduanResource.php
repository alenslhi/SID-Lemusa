<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriPengaduanResource\Pages;
use App\Models\KategoriPengaduan;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KategoriPengaduanResource extends Resource
{
    protected static ?string $model = KategoriPengaduan::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-tag';

    protected static string | \UnitEnum | null $navigationGroup = 'Pengaduan';

    protected static ?string $navigationLabel = 'Kategori Pengaduan';

    protected static ?string $modelLabel = 'Kategori Pengaduan';

    protected static ?string $pluralModelLabel = 'Kategori Pengaduan';

    protected static ?int $navigationSort = 1;

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
                Tables\Columns\TextColumn::make('pengaduan_count')
                    ->label('Jumlah Pengaduan')
                    ->counts('pengaduan')
                    ->sortable(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([\Filament\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageKategoriPengaduan::route('/')];
    }
}
