<?php

namespace App\Filament\Widgets;

use App\Models\Penduduk;
use Filament\Widgets\ChartWidget;

class PendudukByGenderChart extends ChartWidget
{
    protected ?string $heading = 'Penduduk Berdasarkan Jenis Kelamin';

    protected static ?int $sort = 2;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $lakilaki = Penduduk::where('jenis_kelamin', 'L')->where('status_penduduk', 'aktif')->count();
        $perempuan = Penduduk::where('jenis_kelamin', 'P')->where('status_penduduk', 'aktif')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jenis Kelamin',
                    'data' => [$lakilaki, $perempuan],
                    'backgroundColor' => ['#3b82f6', '#ec4899'],
                ],
            ],
            'labels' => ['Laki-laki', 'Perempuan'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
