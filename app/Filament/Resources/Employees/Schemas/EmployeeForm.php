<?php

namespace App\Filament\Resources\Employees\Schemas;

use App\Models\Employee;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pegawai')
                    ->description('Lengkapi data pegawai dengan benar.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('nama_pegawai')
                                    ->label('Nama Pegawai')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Masukkan nama lengkap pegawai')
                                    ->columnSpanFull(),

                                Select::make('jenis_kelamin')
                                    ->label('Jenis Kelamin')
                                    ->options(Employee::JENIS_KELAMIN_OPTIONS)
                                    ->required()
                                    ->native(false),

                                Select::make('pendidikan_terakhir')
                                    ->label('Pendidikan Terakhir')
                                    ->options(Employee::PENDIDIKAN_OPTIONS)
                                    ->required()
                                    ->native(false),

                                DatePicker::make('tanggal_lahir')
                                    ->label('Tanggal Lahir')
                                    ->required()
                                    ->maxDate(now())
                                    ->displayFormat('d/m/Y')
                                    ->native(false)
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}
