<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EmployeeStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalPegawai = Employee::count();
        $totalLaki = Employee::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = Employee::where('jenis_kelamin', 'Perempuan')->count();

        $persenLaki = $totalPegawai > 0 ? round(($totalLaki / $totalPegawai) * 100, 1) : 0;
        $persenPerempuan = $totalPegawai > 0 ? round(($totalPerempuan / $totalPegawai) * 100, 1) : 0;

        return [
            Stat::make('Total Pegawai', number_format($totalPegawai, 0, ',', '.').' Orang')
                ->description('Total keseluruhan pegawai')
                ->descriptionIcon(Heroicon::OutlinedUsers)
                ->color('primary'),

            Stat::make('Pegawai Laki-laki', number_format($totalLaki, 0, ',', '.').' Orang')
                ->description("{$persenLaki}% dari total pegawai")
                ->descriptionIcon(Heroicon::OutlinedUser)
                ->color('info'),

            Stat::make('Pegawai Perempuan', number_format($totalPerempuan, 0, ',', '.').' Orang')
                ->description("{$persenPerempuan}% dari total pegawai")
                ->descriptionIcon(Heroicon::OutlinedUser)
                ->color('warning'),
        ];
    }
}
