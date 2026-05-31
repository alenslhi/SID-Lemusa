<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KeluargaResource\Pages;
use App\Models\Keluarga;
use App\Models\Dusun;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KeluargaResource extends Resource
{
    protected static ?string $model = Keluarga::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-home';

    protected static string | \UnitEnum | null $navigationGroup = 'Kependudukan';

    protected static ?string $navigationLabel = 'Kartu Keluarga';

    protected static ?string $modelLabel = 'Kartu Keluarga';

    protected static ?string $pluralModelLabel = 'Kartu Keluarga';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Kartu Keluarga')
                    ->schema([
                        Forms\Components\TextInput::make('nomor_kk')
                            ->label('Nomor KK')
                            ->required()
                            ->length(16)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Masukkan 16 digit nomor KK'),
                        Forms\Components\Select::make('dusun_id')
                            ->label('Dusun')
                            ->relationship('dusun', 'nama')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Textarea::make('alamat')
                            ->required()
                            ->rows(3),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('rt')
                                    ->label('RT')
                                    ->required()
                                    ->maxLength(5),
                                Forms\Components\TextInput::make('rw')
                                    ->label('RW')
                                    ->required()
                                    ->maxLength(5),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_kk')
                    ->label('Nomor KK')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('dusun.nama')
                    ->label('Dusun')
                    ->sortable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->limit(40)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 40 ? $state : null;
                    }),
                Tables\Columns\TextColumn::make('rt')->label('RT'),
                Tables\Columns\TextColumn::make('rw')->label('RW'),
                Tables\Columns\TextColumn::make('penduduk_count')
                    ->label('Anggota')
                    ->counts('penduduk')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('dusun_id')
                    ->label('Dusun')
                    ->relationship('dusun', 'nama'),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKeluarga::route('/'),
            'create' => Pages\CreateKeluarga::route('/create'),
            'edit' => Pages\EditKeluarga::route('/{record}/edit'),
        ];
    }
}
