<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilDesaResource\Pages;
use App\Domain\ProfilDesa\Models\ProfilDesa;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProfilDesaResource extends Resource
{
    protected static ?string $model = ProfilDesa::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-office';
    protected static string | \UnitEnum | null $navigationGroup = 'Profil Desa';
    protected static ?string $navigationLabel = 'Profil Desa';
    protected static ?string $modelLabel = 'Profil Desa';
    protected static ?string $pluralModelLabel = 'Profil Desa';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\Section::make('Identitas Desa')
                ->schema([
                    Forms\Components\TextInput::make('nama_desa')->required()->maxLength(255),
                    Forms\Components\TextInput::make('email')->email()->maxLength(255),
                    Forms\Components\TextInput::make('telepon')->maxLength(50),
                    Forms\Components\Textarea::make('alamat')->rows(3),
                ])->columns(2),
            Forms\Components\Section::make('Visi & Misi')
                ->schema([
                    Forms\Components\RichEditor::make('visi'),
                    Forms\Components\RichEditor::make('misi'),
                ])->columns(1),
            Forms\Components\Section::make('Informasi Lainnya')
                ->schema([
                    Forms\Components\RichEditor::make('sejarah'),
                    Forms\Components\RichEditor::make('sambutan_kepala_desa')->label('Sambutan Kepala Desa'),
                    Forms\Components\Textarea::make('maps_embed')
                        ->label('Google Maps Embed Code')
                        ->rows(4)
                        ->placeholder('<iframe src="..."></iframe>'),
                ])->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_desa')->sortable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('telepon'),
                Tables\Columns\TextColumn::make('updated_at')->label('Terakhir Diubah')->dateTime('d M Y H:i'),
            ])
            ->actions([\Filament\Actions\EditAction::make()])
            ->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfilDesa::route('/'),
            'edit' => Pages\EditProfilDesa::route('/{record}/edit'),
        ];
    }
}
