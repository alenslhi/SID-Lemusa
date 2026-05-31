<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerangkatDesaResource\Pages;
use App\Models\PerangkatDesa;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PerangkatDesaResource extends Resource
{
    protected static ?string $model = PerangkatDesa::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-group';
    protected static string | \UnitEnum | null $navigationGroup = 'Profil Desa';
    protected static ?string $navigationLabel = 'Perangkat Desa';
    protected static ?string $modelLabel = 'Perangkat Desa';
    protected static ?string $pluralModelLabel = 'Perangkat Desa';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')->required()->maxLength(150),
            Forms\Components\TextInput::make('jabatan')->required()->maxLength(150),
            Forms\Components\FileUpload::make('foto')
                ->image()->directory('perangkat-desa')->maxSize(2048)
                ->imageResizeMode('cover')
                ->imageCropAspectRatio('1:1')
                ->imageResizeTargetWidth('300')
                ->imageResizeTargetHeight('300'),
            Forms\Components\TextInput::make('urutan')
                ->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')->circular(),
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('jabatan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('urutan')->sortable(),
            ])
            ->defaultSort('urutan', 'asc')
            ->reorderable('urutan')
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([\Filament\Actions\BulkActionGroup::make([\Filament\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManagePerangkatDesa::route('/')];
    }
}
