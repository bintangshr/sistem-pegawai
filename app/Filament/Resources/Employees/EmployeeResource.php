<?php

namespace App\Filament\Resources\Employees;

use App\Filament\Resources\Employees\Pages\CreateEmployee;
use App\Filament\Resources\Employees\Pages\EditEmployee;
use App\Filament\Resources\Employees\Pages\ListEmployees;
use App\Filament\Resources\Employees\Pages\ViewEmployee;
use App\Filament\Resources\Employees\Schemas\EmployeeForm;
use App\Filament\Resources\Employees\Schemas\EmployeeInfolist;
use App\Filament\Resources\Employees\Tables\EmployeesTable;
use App\Models\Employee;
use BackedEnum;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

/**
 * Resource Filament untuk mengelola data master pegawai.
 */
/**
 * Resource Filament untuk mengelola data master pegawai.
 */
class EmployeeResource extends Resource
{
    /**
     * Model Eloquent yang dikaitkan dengan resource ini.
     *
     * @var class-string<Employee>|null
     */
    /**
     * Model Eloquent yang dikaitkan dengan resource ini.
     *
     * @var class-string<Employee>|null
     */
    protected static ?string $model = Employee::class;

    /**
     * Label entitas tunggal untuk tampilan antarmuka panel.
     */
    /**
     * Label entitas tunggal untuk tampilan antarmuka panel.
     */
    protected static ?string $modelLabel = 'Pegawai';

    /**
     * Label entitas jamak untuk tampilan antarmuka panel.
     */
    /**
     * Label entitas jamak untuk tampilan antarmuka panel.
     */
    protected static ?string $pluralModelLabel = 'Data Pegawai';

    /**
     * Label teks yang ditampilkan pada menu navigasi sidebar.
     */
    /**
     * Label teks yang ditampilkan pada menu navigasi sidebar.
     */
    protected static ?string $navigationLabel = 'Data Pegawai';

    /**
     * Ikon yang digunakan pada menu navigasi sidebar panel.
     */
    /**
     * Ikon yang digunakan pada menu navigasi sidebar panel.
     */
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    /**
     * Nomor urutan menu pada navigasi sidebar panel.
     */
    /**
     * Nomor urutan menu pada navigasi sidebar panel.
     */
    protected static ?int $navigationSort = 2;

    /**
     * Atribut model yang digunakan sebagai judul rekaman pada pencarian global dan navigasi.
     */
    /**
     * Atribut model yang digunakan sebagai judul rekaman pada pencarian global dan navigasi.
     */
    protected static ?string $recordTitleAttribute = 'nama_pegawai';

    /**
     * Mengonfigurasi skema formulir tambah dan ubah data pegawai.
     *
     * @param  Schema  $schema  Objek skema formulir yang akan dikonfigurasi
     * @return Schema Objek skema yang telah dikonfigurasi
     */
    /**
     * Mengonfigurasi skema formulir tambah dan ubah data pegawai.
     *
     * @param  Schema  $schema  Objek skema formulir yang akan dikonfigurasi
     * @return Schema Objek skema yang telah dikonfigurasi
     */
    public static function form(Schema $schema): Schema
    {
        return EmployeeForm::configure($schema);
    }

    /**
     * Mengonfigurasi skema infolist untuk melihat detail data pegawai.
     *
     * @param  Schema  $schema  Objek skema infolist yang akan dikonfigurasi
     * @return Schema Objek skema yang telah dikonfigurasi
     */
    /**
     * Mengonfigurasi skema infolist untuk melihat detail data pegawai.
     *
     * @param  Schema  $schema  Objek skema infolist yang akan dikonfigurasi
     * @return Schema Objek skema yang telah dikonfigurasi
     */
    public static function infolist(Schema $schema): Schema
    {
        return EmployeeInfolist::configure($schema);
    }

    /**
     * Mengonfigurasi tabel daftar data pegawai beserta kolom, filter, dan aksi.
     *
     * @param  Table  $table  Objek tabel Filament yang akan dikonfigurasi
     * @return Table Objek tabel yang telah dikonfigurasi
     */
    /**
     * Mengonfigurasi tabel daftar data pegawai beserta kolom, filter, dan aksi.
     *
     * @param  Table  $table  Objek tabel Filament yang akan dikonfigurasi
     * @return Table Objek tabel yang telah dikonfigurasi
     */
    public static function table(Table $table): Table
    {
        return EmployeesTable::configure($table);
    }

    /**
     * Mendaftarkan pengelola relasi (relation managers) untuk resource ini.
     *
     * @return array<int, class-string> Daftar kelas relation manager
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * Mendaftarkan rute dan halaman yang tersedia pada resource pegawai.
     *
     * @return array{
     *     index: PageRegistration,
     *     create: PageRegistration,
     *     view: PageRegistration,
     *     edit: PageRegistration
     * } Daftar pemetaan rute halaman Filament
     */
    /**
     * Mendaftarkan rute dan halaman yang tersedia pada resource pegawai.
     *
     * @return array{
     *     index: PageRegistration,
     *     create: PageRegistration,
     *     view: PageRegistration,
     *     edit: PageRegistration
     * } Daftar pemetaan rute halaman Filament
     */
    public static function getPages(): array
    {
        return [
            'index' => ListEmployees::route('/'),
            'create' => CreateEmployee::route('/create'),
            'view' => ViewEmployee::route('/{record}'),
            'edit' => EditEmployee::route('/{record}/edit'),
        ];
    }
}
