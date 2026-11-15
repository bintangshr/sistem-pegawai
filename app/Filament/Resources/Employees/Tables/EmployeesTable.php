<?php

namespace App\Filament\Resources\Employees\Tables;

use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

/**
 * Konfigurasi tabel data pegawai pada panel Filament.
 */
class EmployeesTable
{
    /**
     * Mengonfigurasi tabel pegawai termasuk kolom data, filter, aksi baris, dan aksi massal.
     *
     * @param  Table  $table  Objek tabel Filament yang akan dikonfigurasi
     * @return Table Objek tabel yang telah selesai dikonfigurasi
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_pegawai')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Laki-laki' => 'info',
                        'Perempuan' => 'danger',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'Laki-laki' => 'heroicon-m-user',
                        'Perempuan' => 'heroicon-m-user-circle',
                        default => 'heroicon-m-user',
                    }),

                TextColumn::make('pendidikan_terakhir')
                    ->label('Pendidikan')
                    ->badge()
                    ->sortable()
                    ->color(fn (string $state): string => match ($state) {
                        'S3', 'S2' => 'success',
                        'D4/S1' => 'primary',
                        'D3', 'D2', 'D1' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('usia')
                    ->label('Usia')
                    ->state(function ($record): string {
                        // Menghitung usia dinamis pegawai dalam tahun penuh dari tanggal lahir menggunakan Carbon.
                        return Carbon::parse($record->tanggal_lahir)->age.' Tahun';
                    })
                    ->badge()
                    ->color('gray'),
            ])
            ->filters([
                SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),
                SelectFilter::make('pendidikan_terakhir')
                    ->label('Pendidikan Terakhir')
                    ->options([
                        'SD' => 'SD',
                        'SMP' => 'SMP',
                        'SMA/SMK' => 'SMA/SMK',
                        'D1' => 'D1',
                        'D2' => 'D2',
                        'D3' => 'D3',
                        'D4/S1' => 'D4/S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->defaultSort('nama_pegawai', 'asc');
    }
}
