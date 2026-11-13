<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use Filament\Widgets\ChartWidget;

class EmployeeEducationChart extends ChartWidget
{
    protected ?string $heading = 'Distribusi Pendidikan Terakhir';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $categories = array_keys(Employee::PENDIDIKAN_OPTIONS);

        $counts = Employee::query()
            ->selectRaw('pendidikan_terakhir, COUNT(*) as aggregate')
            ->groupBy('pendidikan_terakhir')
            ->pluck('aggregate', 'pendidikan_terakhir')
            ->all();

        $data = [];
        foreach ($categories as $category) {
            $data[] = (int) ($counts[$category] ?? 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pegawai',
                    'data' => $data,
                    'backgroundColor' => [
                        '#6366f1',
                        '#8b5cf6',
                        '#ec4899',
                        '#f43f5e',
                        '#f97316',
                        '#eab308',
                        '#10b981',
                        '#06b6d4',
                        '#3b82f6',
                    ],
                    'borderRadius' => 4,
                ],
            ],
            'labels' => $categories,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
