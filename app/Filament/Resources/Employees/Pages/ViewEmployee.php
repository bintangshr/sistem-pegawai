<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

/**
 * Halaman untuk menampilkan rincian informasi lengkap pegawai secara mendalam.
 */
class ViewEmployee extends ViewRecord
{
    /**
     * Resource Filament yang diasosiasikan dengan halaman ini.
     *
     * @var class-string<EmployeeResource>
     */
    protected static string $resource = EmployeeResource::class;

    /**
     * Judul heading halaman rincian data pegawai.
     */
    protected ?string $heading = 'Detail Data Pegawai';

    /**
     * Mendaftarkan daftar aksi tombol yang berada pada header halaman rincian pegawai.
     *
     * @return array<int, Action|ActionGroup> Daftar aksi tombol header
     */
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Ubah'),
        ];
    }
}
