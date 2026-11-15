<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use Filament\Widgets\ChartWidget;

/**
 * Widget diagram batang untuk menampilkan sebaran distribusi tingkat pendidikan terakhir pegawai.
 */
class EmployeeEducationChart extends ChartWidget
{
    /**
     * Judul heading widget grafik distribusi pendidikan terakhir.
     */
    protected ?string $heading = 'Distribusi Pendidikan Terakhir';

    /**
     * Urutan penempatan posisi widget pada dashboard.
     */
    protected static ?int $sort = 3;

    /**
     * Lebar kolom grid yang ditempati widget pada layout dashboard.
     *
     * @var int|string|array<string, int|string|null>
     */
    protected int|string|array $columnSpan = 1;

    /**
     * Mengambil, mengelompokkan, dan menyusun data jumlah pegawai per jenjang pendidikan terakhir.
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
        $categories = array_keys(Employee::PENDIDIKAN_OPTIONS);

        // Mengelompokkan dan mengagregasi jumlah pegawai berdasarkan jenjang pendidikan terakhir dari basis data.
        $counts = Employee::query()
            ->selectRaw('pendidikan_terakhir, COUNT(*) as aggregate')
            ->groupBy('pendidikan_terakhir')
            ->pluck('aggregate', 'pendidikan_terakhir')
            ->all();

        // Menyusun nilai frekuensi data sesuai urutan hierarki jenjang pendidikan master.
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
