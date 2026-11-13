<?php

namespace App\Filament\Resources\Employees\Schemas;

use App\Models\Employee;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EmployeeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Pegawai')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('nama_pegawai')
                                    ->label('Nama Pegawai')
                                    ->columnSpanFull(),

                                TextEntry::make('jenis_kelamin')
                                    ->label('Jenis Kelamin')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'Laki-laki' => 'info',
                                        'Perempuan' => 'warning',
                                        default => 'gray',
                                    }),

                                TextEntry::make('pendidikan_terakhir')
                                    ->label('Pendidikan Terakhir')
                                    ->badge(),

                                TextEntry::make('tanggal_lahir')
                                    ->label('Tanggal Lahir')
                                    ->date('d/m/Y'),

                                TextEntry::make('usia')
                                    ->label('Usia')
                                    ->state(fn (Employee $record): string => $record->usia !== null ? "{$record->usia} tahun" : '-'),

                                TextEntry::make('created_at')
                                    ->label('Tanggal Terdaftar')
                                    ->dateTime('d/m/Y H:i'),

                                TextEntry::make('updated_at')
                                    ->label('Terakhir Diperbarui')
                                    ->dateTime('d/m/Y H:i'),
                            ]),
                    ]),
            ]);
    }
}
