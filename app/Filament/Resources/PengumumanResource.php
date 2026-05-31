<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengumumanResource\Pages;
use App\Domain\Pengumuman\Models\Pengumuman;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengumumanResource extends Resource
{
    protected static ?string $model = Pengumuman::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-speaker-wave';

    protected static string | \UnitEnum | null $navigationGroup = 'Informasi Desa';

    protected static ?string $navigationLabel = 'Pengumuman';

    protected static ?string $modelLabel = 'Pengumuman';

    protected static ?string $pluralModelLabel = 'Pengumuman';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\TextInput::make('judul')->required()->maxLength(255),
            Forms\Components\RichEditor::make('isi')->required()->columnSpanFull(),
            Forms\Components\DatePicker::make('mulai_tampil')->required(),
            Forms\Components\DatePicker::make('selesai_tampil')->required()->after('mulai_tampil'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable()->sortable()->limit(50),
                Tables\Columns\TextColumn::make('mulai_tampil')->date('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('selesai_tampil')->date('d M Y')->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->getStateUsing(fn ($record) => now()->between($record->mulai_tampil, $record->selesai_tampil)),
            ])
            ->defaultSort('mulai_tampil', 'desc')
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
        return [
            'index' => Pages\ListPengumuman::route('/'),
            'create' => Pages\CreatePengumuman::route('/create'),
            'edit' => Pages\EditPengumuman::route('/{record}/edit'),
        ];
    }
}
