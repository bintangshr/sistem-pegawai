<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

/**
 * Halaman untuk menampilkan daftar seluruh data pegawai dalam format tabel.
 */
class ListEmployees extends ListRecords
{
    /**
     * Resource Filament yang diasosiasikan dengan halaman ini.
     *
     * @var class-string<EmployeeResource>
     */
    protected static string $resource = EmployeeResource::class;

    /**
     * Judul heading halaman daftar data pegawai.
     */
    protected ?string $heading = 'Data Pegawai';

    /**
     * Mendaftarkan daftar aksi tombol yang berada pada header halaman daftar pegawai.
     *
     * @return array<int, Action|ActionGroup> Daftar aksi tombol header
     */
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Pegawai')
                ->icon(Heroicon::OutlinedPlus),
        ];
    }
}
