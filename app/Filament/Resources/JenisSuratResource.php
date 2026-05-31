<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisSuratResource\Pages;
use App\Domain\Surat\Models\JenisSurat;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JenisSuratResource extends Resource
{
    protected static ?string $model = JenisSurat::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-duplicate';

    protected static string | \UnitEnum | null $navigationGroup = 'Persuratan';

    protected static ?string $navigationLabel = 'Jenis Surat';

    protected static ?string $modelLabel = 'Jenis Surat';

    protected static ?string $pluralModelLabel = 'Jenis Surat';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')->required()->maxLength(150),
            Forms\Components\Textarea::make('deskripsi')->rows(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')->limit(60),
                Tables\Columns\TextColumn::make('pengajuan_surat_count')
                    ->label('Pengajuan')
                    ->counts('pengajuanSurat')
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
            'index' => Pages\ManageJenisSurat::route('/'),
        ];
    }
}
