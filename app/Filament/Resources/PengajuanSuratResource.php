<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanSuratResource\Pages;
use App\Domain\Surat\Models\PengajuanSurat;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengajuanSuratResource extends Resource
{
    protected static ?string $model = PengajuanSurat::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static string | \UnitEnum | null $navigationGroup = 'Persuratan';

    protected static ?string $navigationLabel = 'Pengajuan Surat';

    protected static ?string $modelLabel = 'Pengajuan Surat';

    protected static ?string $pluralModelLabel = 'Pengajuan Surat';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pengajuan')
                    ->schema([
                        Forms\Components\TextInput::make('kode_pengajuan')
                            ->label('Kode Pengajuan')
                            ->default(fn () => 'SRT-' . strtoupper(uniqid()))
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->disabled()
                            ->dehydrated(),
                        Forms\Components\Select::make('penduduk_id')
                            ->label('Penduduk')
                            ->relationship('penduduk', 'nama_lengkap')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('jenis_surat_id')
                            ->label('Jenis Surat')
                            ->relationship('jenisSurat', 'nama')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('status_surat_id')
                            ->label('Status')
                            ->relationship('statusSurat', 'nama')
                            ->default(1)
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Repeater::make('lampiran')
                            ->relationship('lampiran')
                            ->schema([
                                Forms\Components\FileUpload::make('path_file')
                                    ->label('Pilih Berkas Lampiran')
                                    ->disk('local')
                                    ->directory('lampiran-surat')
                                    ->maxSize(5120)
                                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'])
                                    ->getUploadedFileNameUsing(fn ($file) => \Illuminate\Support\Str::uuid() . '.' . $file->getClientOriginalExtension())
                                    ->storeFileNamesIn('nama_file')
                                    ->storeFilesizesIn('ukuran_file')
                                    ->required(),
                            ])
                            ->columnSpanFull()
                            ->label('Lampiran Dokumen')
                            ->grid(2),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pemrosesan')
                    ->schema([
                        Forms\Components\DateTimePicker::make('estimasi_selesai')
                            ->label('Estimasi Selesai'),
                        Forms\Components\Textarea::make('catatan_admin')
                            ->label('Catatan Admin')
                            ->rows(3),
                        Forms\Components\Select::make('diproses_oleh')
                            ->label('Diproses Oleh')
                            ->relationship('prosesOleh', 'name')
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Hasil Surat')
                    ->relationship('suratHasil')
                    ->schema([
                        Forms\Components\TextInput::make('nomor_surat')
                            ->label('Nomor Surat')
                            ->required(),
                        Forms\Components\FileUpload::make('file_pdf')
                            ->label('Unduh / Unggah Berkas PDF')
                            ->disk('local')
                            ->directory('surat-hasil')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(5120)
                            ->getUploadedFileNameUsing(fn ($file) => \Illuminate\Support\Str::uuid() . '.' . $file->getClientOriginalExtension())
                            ->required(),
                        Forms\Components\Hidden::make('uploaded_by')
                            ->default(auth()->id()),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_pengajuan')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('penduduk.nama_lengkap')
                    ->label('Pemohon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenisSurat.nama')
                    ->label('Jenis Surat')
                    ->sortable(),
                Tables\Columns\TextColumn::make('statusSurat.nama')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($record): string => match ($record->status_surat_id) {
                        1 => 'warning',
                        2 => 'danger',
                        3 => 'info',
                        4 => 'warning',
                        5 => 'success',
                        6 => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('prosesOleh.name')
                    ->label('Operator')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Ajuan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status_surat_id')
                    ->label('Status')
                    ->relationship('statusSurat', 'nama'),
                Tables\Filters\SelectFilter::make('jenis_surat_id')
                    ->label('Jenis Surat')
                    ->relationship('jenisSurat', 'nama'),
            ])
            ->actions([
                \Filament\Actions\Action::make('download_surat')
                    ->label('Unduh Surat')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn ($record) => $record->suratHasil()->exists())
                    ->action(fn ($record) => redirect()->route('file.download', ['path' => $record->suratHasil->file_pdf])),
                \Filament\Actions\Action::make('download_lampiran')
                    ->label('Unduh Lampiran')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('info')
                    ->visible(fn ($record) => $record->lampiran()->exists())
                    ->action(fn ($record) => redirect()->route('file.download', ['path' => $record->lampiran()->first()->path_file])),
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

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->check() && ! auth()->user()->hasRole('Super Admin') && ! auth()->user()->hasPermissionTo('proses_surat')) {
            $query->where('penduduk_id', auth()->user()->penduduk?->id);
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengajuanSurat::route('/'),
            'create' => Pages\CreatePengajuanSurat::route('/create'),
            'view' => Pages\ViewPengajuanSurat::route('/{record}'),
            'edit' => Pages\EditPengajuanSurat::route('/{record}/edit'),
        ];
    }
}
