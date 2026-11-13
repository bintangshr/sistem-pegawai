<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use App\Models\Employee;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected ?string $heading = 'Ubah Data Pegawai';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Data Pegawai Berhasil Diperbarui')
            ->body('Perubahan data pegawai telah tersimpan di sistem.');
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()
                ->label('Lihat'),

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
        ];
    }
}
