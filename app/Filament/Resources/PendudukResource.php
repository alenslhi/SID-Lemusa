<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendudukResource\Pages;
use App\Domain\Penduduk\Models\Penduduk;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PendudukResource extends Resource
{
    protected static ?string $model = Penduduk::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-identification';

    protected static string | \UnitEnum | null $navigationGroup = 'Kependudukan';

    protected static ?string $navigationLabel = 'Data Penduduk';

    protected static ?string $modelLabel = 'Penduduk';

    protected static ?string $pluralModelLabel = 'Data Penduduk';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pribadi')
                    ->schema([
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->required()
                            ->length(16)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('nama_lengkap')
                            ->required()
                            ->maxLength(150),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('tempat_lahir')
                                    ->required()
                                    ->maxLength(100),
                                Forms\Components\DatePicker::make('tanggal_lahir')
                                    ->required()
                                    ->maxDate(now()),
                            ]),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->options(\App\Domain\Penduduk\Enums\JenisKelamin::class)
                            ->required(),
                        Forms\Components\Select::make('agama_id')
                            ->label('Agama')
                            ->relationship('agama', 'nama')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('status_perkawinan_id')
                            ->label('Status Perkawinan')
                            ->relationship('statusPerkawinan', 'nama')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pendidikan & Pekerjaan')
                    ->schema([
                        Forms\Components\Select::make('pendidikan_id')
                            ->label('Pendidikan Terakhir')
                            ->relationship('pendidikan', 'nama')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('pekerjaan_id')
                            ->label('Pekerjaan')
                            ->relationship('pekerjaan', 'nama')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Data Keluarga & Alamat')
                    ->schema([
                        Forms\Components\Select::make('keluarga_id')
                            ->label('Kartu Keluarga')
                            ->relationship('keluarga', 'nomor_kk')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('user_id')
                            ->label('Akun User (Opsional)')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Pilih jika penduduk memiliki akun'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Kontak & Status')
                    ->schema([
                        Forms\Components\TextInput::make('no_hp')
                            ->label('No. HP')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\Select::make('status_penduduk')
                            ->label('Status Penduduk')
                            ->options(\App\Domain\Penduduk\Enums\StatusPenduduk::class)
                            ->default(\App\Domain\Penduduk\Enums\StatusPenduduk::AKTIF)
                            ->required(),
                        Forms\Components\FileUpload::make('foto')
                            ->image()
                            ->directory('penduduk-foto')
                            ->maxSize(2048)
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('300')
                            ->imageResizeTargetHeight('300'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->circular()
                    ->defaultImageUrl(fn () => 'https://ui-avatars.com/api/?name=P&background=random'),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('JK')
                    ->badge(),
                Tables\Columns\TextColumn::make('keluarga.nomor_kk')
                    ->label('No. KK')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('agama.nama')
                    ->label('Agama')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pekerjaan.nama')
                    ->label('Pekerjaan')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status_penduduk')
                    ->label('Status')
                    ->badge(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->options(\App\Domain\Penduduk\Enums\JenisKelamin::class),
                Tables\Filters\SelectFilter::make('agama_id')
                    ->label('Agama')
                    ->relationship('agama', 'nama'),
                Tables\Filters\SelectFilter::make('status_penduduk')
                    ->options(\App\Domain\Penduduk\Enums\StatusPenduduk::class),
                Tables\Filters\SelectFilter::make('keluarga_id')
                    ->label('Kartu Keluarga')
                    ->relationship('keluarga', 'nomor_kk')
                    ->searchable()
                    ->preload(),
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
            'index' => Pages\ListPenduduk::route('/'),
            'create' => Pages\CreatePenduduk::route('/create'),
            'view' => Pages\ViewPenduduk::route('/{record}'),
            'edit' => Pages\EditPenduduk::route('/{record}/edit'),
        ];
    }
}
