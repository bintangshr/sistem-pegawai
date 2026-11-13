<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use Filament\Widgets\ChartWidget;

class EmployeeAgeChart extends ChartWidget
{
    protected ?string $heading = 'Distribusi Kelompok Usia';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $ageGroups = [
            '<20' => 0,
            '20–29' => 0,
            '30–39' => 0,
            '40–49' => 0,
            '50–59' => 0,
            '≥60' => 0,
        ];

        $employees = Employee::query()->select('tanggal_lahir')->get();

        foreach ($employees as $employee) {
            if (! $employee->tanggal_lahir) {
                continue;
            }

            $age = $employee->tanggal_lahir->age;

            if ($age < 20) {
                $ageGroups['<20']++;
            } elseif ($age <= 29) {
                $ageGroups['20–29']++;
            } elseif ($age <= 39) {
                $ageGroups['30–39']++;
            } elseif ($age <= 49) {
                $ageGroups['40–49']++;
            } elseif ($age <= 59) {
                $ageGroups['50–59']++;
            } else {
                $ageGroups['≥60']++;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pegawai',
                    'data' => array_values($ageGroups),
                    'backgroundColor' => [
                        '#38bdf8',
                        '#3b82f6',
                        '#6366f1',
                        '#8b5cf6',
                        '#a855f7',
                        '#d946ef',
                    ],
                    'borderRadius' => 4,
                ],
            ],
            'labels' => array_keys($ageGroups),
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
