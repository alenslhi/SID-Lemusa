<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaduanResource\Pages;
use App\Models\Pengaduan;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-megaphone';

    protected static string | \UnitEnum | null $navigationGroup = 'Pengaduan';

    protected static ?string $navigationLabel = 'Pengaduan Masyarakat';

    protected static ?string $modelLabel = 'Pengaduan';

    protected static ?string $pluralModelLabel = 'Pengaduan';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Pengaduan')
                ->schema([
                    Forms\Components\Select::make('penduduk_id')
                        ->label('Pelapor')
                        ->relationship('penduduk', 'nama_lengkap')
                        ->required()->searchable()->preload(),
                    Forms\Components\Select::make('kategori_pengaduan_id')
                        ->label('Kategori')
                        ->relationship('kategoriPengaduan', 'nama')
                        ->required()->searchable()->preload(),
                    Forms\Components\TextInput::make('judul')->required()->maxLength(255),
                    Forms\Components\RichEditor::make('isi_laporan')
                        ->label('Isi Laporan')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\Select::make('status')
                        ->options([
                            'baru' => 'Baru',
                            'diproses' => 'Diproses',
                            'selesai' => 'Selesai',
                            'ditolak' => 'Ditolak',
                        ])
                        ->default('baru')
                        ->required(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('penduduk.nama_lengkap')
                    ->label('Pelapor')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('kategoriPengaduan.nama')
                    ->label('Kategori')->sortable(),
                Tables\Columns\TextColumn::make('judul')->searchable()->limit(40),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baru' => 'warning',
                        'diproses' => 'info',
                        'selesai' => 'success',
                        'ditolak' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'baru' => 'Baru',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                        'ditolak' => 'Ditolak',
                    ]),
                Tables\Filters\SelectFilter::make('kategori_pengaduan_id')
                    ->label('Kategori')
                    ->relationship('kategoriPengaduan', 'nama'),
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

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->check() && ! auth()->user()->hasRole('Super Admin') && ! auth()->user()->hasPermissionTo('proses_pengaduan')) {
            $query->where('penduduk_id', auth()->user()->penduduk?->id);
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaduan::route('/'),
            'create' => Pages\CreatePengaduan::route('/create'),
            'view' => Pages\ViewPengaduan::route('/{record}'),
            'edit' => Pages\EditPengaduan::route('/{record}/edit'),
        ];
    }
}
