<?php

namespace App\Filament\Widgets;

use App\Models\Keluarga;
use App\Models\Penduduk;
use App\Models\PengajuanSurat;
use App\Models\Pengaduan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Penduduk', Penduduk::where('status_penduduk', 'aktif')->count())
                ->description('Penduduk aktif')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5]),

            Stat::make('Kartu Keluarga', Keluarga::count())
                ->description('Total KK terdaftar')
                ->descriptionIcon('heroicon-m-home')
                ->color('info')
                ->chart([3, 5, 2, 8, 4, 6, 3]),

            Stat::make('Pengajuan Surat', PengajuanSurat::whereHas('statusSurat', fn ($q) => $q->whereNotIn('nama', ['Selesai', 'Ditolak']))->count())
                ->description('Sedang diproses')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning')
                ->chart([2, 4, 6, 2, 3, 5, 4]),

            Stat::make('Pengaduan', Pengaduan::where('status', 'baru')->count())
                ->description('Pengaduan baru')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('danger')
                ->chart([1, 3, 2, 5, 4, 2, 1]),
        ];
    }
}
