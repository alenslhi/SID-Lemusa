<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Models\Agenda;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-calendar-days';
    protected static string | \UnitEnum | null $navigationGroup = 'Informasi Desa';
    protected static ?string $navigationLabel = 'Agenda Desa';
    protected static ?string $modelLabel = 'Agenda';
    protected static ?string $pluralModelLabel = 'Agenda';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\TextInput::make('judul')->required()->maxLength(255),
            Forms\Components\RichEditor::make('deskripsi')->columnSpanFull(),
            Forms\Components\TextInput::make('lokasi')->maxLength(255),
            Forms\Components\DateTimePicker::make('tanggal_mulai')->required(),
            Forms\Components\DateTimePicker::make('tanggal_selesai')->required()->after('tanggal_mulai'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable()->sortable()->limit(50),
                Tables\Columns\TextColumn::make('lokasi')->limit(30),
                Tables\Columns\TextColumn::make('tanggal_mulai')->dateTime('d M Y H:i')->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')->dateTime('d M Y H:i')->sortable(),
            ])
            ->defaultSort('tanggal_mulai', 'desc')
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([\Filament\Actions\BulkActionGroup::make([\Filament\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgenda::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}
