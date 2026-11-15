<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use Filament\Widgets\ChartWidget;

/**
 * Widget diagram donat untuk menampilkan komposisi rasio jenis kelamin pegawai.
 */
class EmployeeGenderChart extends ChartWidget
{
    /**
     * Judul heading widget grafik komposisi jenis kelamin.
     */
    protected ?string $heading = 'Komposisi Jenis Kelamin';

    /**
     * Urutan penempatan widget pada dashboard.
     */
    protected static ?int $sort = 2;

    /**
     * Lebar kolom grid yang ditempati widget pada layout dashboard.
     *
     * @var int|string|array<string, int|string|null>
     */
    protected int|string|array $columnSpan = 1;

    /**
     * Mengambil dan mengelompokkan data rasio pegawai berdasarkan jenis kelamin untuk ditampilkan pada diagram.
     *
     * @return array{
     *     datasets: array<int, array{
     *         label: string,
     *         data: array<int, int>,
     *         backgroundColor: array<int, string>,
     *         borderColor: array<int, string>,
     *         borderWidth: int
     *     }>,
     *     labels: array<int, string>
     * } Data diagram terstruktur untuk Chart.js
     */
    protected function getData(): array
    {
        // Mengelompokkan dan menghitung total jumlah pegawai berdasarkan kategori jenis kelamin.
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

    /**
     * Menentukan tipe visualisasi diagram Chart.js yang digunakan.
     */
    protected function getType(): string
    {
        return 'doughnut';
    }

    /**
     * Mengonfigurasi opsi konfigurasi dan tampilan grafik Chart.js.
     *
     * @return array{
     *     plugins: array{
     *         legend: array{
     *             display: bool,
     *             position: string
     *         },
     *         tooltip: array{
     *             enabled: bool
     *         }
     *     },
     *     maintainAspectRatio: bool
     * } Opsi konfigurasi Chart.js
     */
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
