<?php

namespace App\Filament\Resources\Employees\Tables;

use App\Models\Employee;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex(),

                TextColumn::make('nama_pegawai')
                    ->label('Nama Pegawai')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Laki-laki' => 'info',
                        'Perempuan' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('pendidikan_terakhir')
                    ->label('Pendidikan Terakhir')
                    ->badge()
                    ->sortable(),

                TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('usia')
                    ->label('Usia')
                    ->state(fn (Employee $record): string => $record->usia !== null ? "{$record->usia} tahun" : '-'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options(Employee::JENIS_KELAMIN_OPTIONS),

                SelectFilter::make('pendidikan_terakhir')
                    ->label('Pendidikan Terakhir')
                    ->options(Employee::PENDIDIKAN_OPTIONS),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Lihat'),

                EditAction::make()
                    ->label('Ubah'),

                DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Data Pegawai?')
                    ->modalDescription(fn (Employee $record): string => "Apakah Anda yakin ingin menghapus data pegawai {$record->nama_pegawai}? Tindakan ini tidak dapat dibatalkan.")
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal')
                    ->color('danger')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Data Pegawai Berhasil Dihapus')
                            ->body('Data pegawai telah dihapus dari sistem.')
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus yang Dipilih')
                        ->modalHeading('Hapus Data Pegawai Terpilih?')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data pegawai yang dipilih? Tindakan ini tidak dapat dibatalkan.')
                        ->modalSubmitActionLabel('Ya, Hapus')
                        ->modalCancelActionLabel('Batal')
                        ->color('danger')
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Data Pegawai Berhasil Dihapus')
                                ->body('Data pegawai terpilih telah dihapus dari sistem.')
                        ),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Data Pegawai')
            ->emptyStateDescription('Silakan klik tombol tambah data pegawai untuk menambahkan pegawai baru.')
            ->emptyStateIcon(Heroicon::OutlinedUsers);
    }
}
