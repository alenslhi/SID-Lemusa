<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MutasiPendudukResource\Pages;
use App\Models\MutasiPenduduk;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MutasiPendudukResource extends Resource
{
    protected static ?string $model = MutasiPenduduk::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-arrow-path';

    protected static string | \UnitEnum | null $navigationGroup = 'Kependudukan';

    protected static ?string $navigationLabel = 'Mutasi Penduduk';

    protected static ?string $modelLabel = 'Mutasi Penduduk';

    protected static ?string $pluralModelLabel = 'Mutasi Penduduk';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\Select::make('penduduk_id')
                    ->label('Penduduk')
                    ->relationship('penduduk', 'nama_lengkap')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('jenis_mutasi')
                    ->options([
                        'lahir' => 'Lahir',
                        'meninggal' => 'Meninggal',
                        'pindah_masuk' => 'Pindah Masuk',
                        'pindah_keluar' => 'Pindah Keluar',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_mutasi')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\Textarea::make('keterangan')
                    ->rows(3),
                Forms\Components\Hidden::make('dibuat_oleh')
                    ->default(auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('penduduk.nama_lengkap')
                    ->label('Penduduk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_mutasi')
                    ->label('Jenis Mutasi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'lahir' => 'success',
                        'meninggal' => 'danger',
                        'pindah_masuk' => 'info',
                        'pindah_keluar' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'lahir' => 'Lahir',
                        'meninggal' => 'Meninggal',
                        'pindah_masuk' => 'Pindah Masuk',
                        'pindah_keluar' => 'Pindah Keluar',
                    }),
                Tables\Columns\TextColumn::make('tanggal_mutasi')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->limit(50),
                Tables\Columns\TextColumn::make('pembuatMutasi.name')
                    ->label('Dibuat Oleh'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_mutasi')
                    ->options([
                        'lahir' => 'Lahir',
                        'meninggal' => 'Meninggal',
                        'pindah_masuk' => 'Pindah Masuk',
                        'pindah_keluar' => 'Pindah Keluar',
                    ]),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMutasiPenduduk::route('/'),
            'create' => Pages\CreateMutasiPenduduk::route('/create'),
        ];
    }
}
