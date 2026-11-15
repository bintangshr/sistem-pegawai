<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

/**
 * Halaman untuk menambahkan data pegawai baru ke dalam sistem.
 */
class CreateEmployee extends CreateRecord
{
    /**
     * Resource Filament yang diasosiasikan dengan halaman ini.
     *
     * @var class-string<EmployeeResource>
     */
    protected static string $resource = EmployeeResource::class;

    /**
     * Judul heading halaman pembuatan data pegawai.
     */
    protected ?string $heading = 'Tambah Data Pegawai';

    /**
     * Mendapatkan URL tujuan pengalihan setelah rekaman berhasil disimpan.
     *
     * @return string URL rute index daftar pegawai
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Menyesuaikan pesan notifikasi yang ditampilkan saat data pegawai berhasil dibuat.
     *
     * @return Notification|null Objek notifikasi Filament
     */
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Data Pegawai Berhasil Ditambahkan')
            ->body('Data pegawai baru telah tersimpan di sistem.');
    }
}
