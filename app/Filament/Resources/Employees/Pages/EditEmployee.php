<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use App\Models\Employee;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

/**
 * Halaman untuk mengubah dan memperbarui data pegawai yang telah ada.
 */
class EditEmployee extends EditRecord
{
    /**
     * Resource Filament yang diasosiasikan dengan halaman ini.
     *
     * @var class-string<EmployeeResource>
     */
    protected static string $resource = EmployeeResource::class;

    /**
     * Judul heading halaman pengubahan data pegawai.
     */
    protected ?string $heading = 'Ubah Data Pegawai';

    /**
     * Mendapatkan URL tujuan pengalihan setelah perubahan rekaman berhasil disimpan.
     *
     * @return string URL rute index daftar pegawai
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Menyesuaikan notifikasi yang ditampilkan saat perubahan data pegawai berhasil disimpan.
     *
     * @return Notification|null Objek notifikasi Filament
     */
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Data Pegawai Berhasil Diperbarui')
            ->body('Perubahan data pegawai telah tersimpan di sistem.');
    }

    /**
     * Mendaftarkan daftar aksi tombol yang berada pada header halaman ubah data pegawai.
     *
     * @return array<int, Action|ActionGroup> Daftar aksi tombol header
     */
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
