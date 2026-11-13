<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * Hanya memasukkan akun Admin untuk kebutuhan awal.
     * Data contoh pegawai dijalankan terpisah via EmployeeSeeder.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
        ]);
    }
}
