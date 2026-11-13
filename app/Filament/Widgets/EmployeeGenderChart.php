<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use Filament\Widgets\ChartWidget;

class EmployeeGenderChart extends ChartWidget
{
    protected ?string $heading = 'Komposisi Jenis Kelamin';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $totalLaki = Employee::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = Employee::where('jenis_kelamin', 'Perempuan')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pegawai',
                    'data' => [$totalLaki, $totalPerempuan],
                    'backgroundColor' => [
                        '#3b82f6', // Biru
                        '#ec4899', // Pink
                    ],
                    'borderColor' => [
                        '#2563eb',
                        '#db2777',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => ['Laki-laki', 'Perempuan'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
            'maintainAspectRatio' => true,
        ];
    }
}
