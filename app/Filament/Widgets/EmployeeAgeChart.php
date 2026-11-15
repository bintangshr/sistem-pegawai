<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use Filament\Widgets\ChartWidget;

/**
 * Widget diagram batang untuk menampilkan sebaran distribusi pegawai berdasarkan kelompok rentang usia.
 */
class EmployeeAgeChart extends ChartWidget
{
    /**
     * Judul heading widget grafik distribusi kelompok usia.
     */
    protected ?string $heading = 'Distribusi Kelompok Usia';

    /**
     * Urutan penempatan posisi widget pada dashboard.
     */
    protected static ?int $sort = 4;

    /**
     * Lebar kolom grid yang ditempati widget pada layout dashboard.
     *
     * @var int|string|array<string, int|string|null>
     */
    protected int|string|array $columnSpan = 'full';

    /**
     * Mengambil dan mengelompokkan data usia pegawai ke dalam kategori rentang usia.
     *
     * @return array{
     *     datasets: array<int, array{
     *         label: string,
     *         data: array<int, int>,
     *         backgroundColor: array<int, string>,
     *         borderRadius: int
     *     }>,
     *     labels: array<int, string>
     * } Data diagram terstruktur untuk Chart.js
     */
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

        // Mengelompokkan data pegawai ke dalam rentang usia menggunakan perhitungan usia dinamis Carbon.
        foreach ($employees as $employee) {
            if (! $employee->tanggal_lahir) {
                continue;
            }

            // Menghitung usia aktual pegawai dalam tahun penuh dari tanggal lahir.
            $age = $employee->tanggal_lahir->age;

            // Klasifikasi pegawai ke dalam interval kelompok usia grafik.
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

    /**
     * Menentukan tipe visualisasi diagram Chart.js yang digunakan.
     */
    protected function getType(): string
    {
        return 'bar';
    }

    /**
     * Mengonfigurasi opsi konfigurasi dan tampilan grafik Chart.js.
     *
     * @return array{
     *     plugins: array{
     *         legend: array{
     *             display: bool
     *         },
     *         tooltip: array{
     *             enabled: bool
     *         }
     *     },
     *     scales: array{
     *         y: array{
     *             beginAtZero: bool,
     *             ticks: array{
     *                 precision: int
     *             }
     *         }
     *     }
     * } Opsi konfigurasi Chart.js
     */
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
