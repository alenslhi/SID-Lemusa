<?php

namespace App\Filament\Widgets;

use App\Domain\Penduduk\Models\Penduduk;
use App\Domain\Penduduk\Models\Agama;
use Filament\Widgets\ChartWidget;

class PendudukByAgamaChart extends ChartWidget
{
    protected ?string $heading = 'Penduduk Berdasarkan Agama';

    protected static ?int $sort = 3;

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $agamaData = Agama::withCount(['penduduk' => function ($query) {
            $query->where('status_penduduk', 'aktif');
        }])->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penduduk',
                    'data' => $agamaData->pluck('penduduk_count')->toArray(),
                    'backgroundColor' => [
                        '#10b981', '#3b82f6', '#f59e0b',
                        '#ef4444', '#8b5cf6', '#06b6d4',
                    ],
                ],
            ],
            'labels' => $agamaData->pluck('nama')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
