<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PotensiDesaResource\Pages;
use App\Domain\PotensiDesa\Models\PotensiDesa;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PotensiDesaResource extends Resource
{
    protected static ?string $model = PotensiDesa::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-star';
    protected static string | \UnitEnum | null $navigationGroup = 'Informasi Desa';
    protected static ?string $navigationLabel = 'Potensi Desa';
    protected static ?string $modelLabel = 'Potensi Desa';
    protected static ?string $pluralModelLabel = 'Potensi Desa';
    protected static ?int $navigationSort = 5;

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\Select::make('kategori_potensi_id')
                ->label('Kategori')
                ->relationship('kategoriPotensi', 'nama')
                ->required()->searchable()->preload(),
            Forms\Components\TextInput::make('nama')->required()->maxLength(255),
            Forms\Components\RichEditor::make('deskripsi')->columnSpanFull(),
            Forms\Components\FileUpload::make('foto')
                ->image()
                ->directory('potensi-desa')
                ->maxSize(2048)
                ->getUploadedFileNameUsing(fn ($file) => \Illuminate\Support\Str::uuid() . '.' . $file->getClientOriginalExtension()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')->square()->size(60),
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('kategoriPotensi.nama')->label('Kategori')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y')->sortable(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([\Filament\Actions\BulkActionGroup::make([\Filament\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPotensiDesa::route('/'),
            'create' => Pages\CreatePotensiDesa::route('/create'),
            'edit' => Pages\EditPotensiDesa::route('/{record}/edit'),
        ];
    }
}
