<?php

namespace Database\Seeders;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Seeder untuk menginisialisasi data awal pegawai dengan variasi demografi.
 */
class EmployeeSeeder extends Seeder
{
    /**
     * Menjalankan proses pengisian (seeding) contoh data pegawai ke dalam basis data.
     * Mengisi minimal 30 data pegawai fiktif dengan keragaman jenis kelamin, jenjang pendidikan, dan rentang usia.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $sampleEmployees = [
            // Kelompok Usia < 20 tahun (usia 18 - 19)
            [
                'nama_pegawai' => 'Lucky Alfiansyah',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'SMA/SMK',
                'tanggal_lahir' => $now->copy()->subYears(18)->subMonths(3)->subDays(12)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Amelia Delfina Putri',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'SMA/SMK',
                'tanggal_lahir' => $now->copy()->subYears(19)->subMonths(7)->subDays(5)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Tito Mariano',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'SMP',
                'tanggal_lahir' => $now->copy()->subYears(18)->subMonths(10)->subDays(2)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Errine Lintang',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'SMA/SMK',
                'tanggal_lahir' => $now->copy()->subYears(19)->subMonths(1)->subDays(18)->format('Y-m-d'),
            ],

            // Kelompok Usia 20–29 tahun
            [
                'nama_pegawai' => 'Pandu Bagus',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'D3',
                'tanggal_lahir' => $now->copy()->subYears(23)->subMonths(4)->subDays(10)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Novi Puspitasari',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'D4/S1',
                'tanggal_lahir' => $now->copy()->subYears(25)->subMonths(2)->subDays(14)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Akmal Ramadhani',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'D1',
                'tanggal_lahir' => $now->copy()->subYears(21)->subMonths(9)->subDays(20)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Siti Aisyah',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'D2',
                'tanggal_lahir' => $now->copy()->subYears(22)->subMonths(6)->subDays(11)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Rifqi Abdurohman',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'D4/S1',
                'tanggal_lahir' => $now->copy()->subYears(27)->subMonths(8)->subDays(25)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Fitri Ayu',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'S2',
                'tanggal_lahir' => $now->copy()->subYears(29)->subMonths(11)->subDays(3)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Ahmad Fauzi',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'SMA/SMK',
                'tanggal_lahir' => $now->copy()->subYears(24)->subMonths(5)->subDays(17)->format('Y-m-d'),
            ],

            // Kelompok Usia 30–39 tahun
            [
                'nama_pegawai' => 'Ahmad Bagas',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'D4/S1',
                'tanggal_lahir' => $now->copy()->subYears(32)->subMonths(3)->subDays(8)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Afiana Putri',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'S2',
                'tanggal_lahir' => $now->copy()->subYears(35)->subMonths(1)->subDays(29)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Helbi Iswantono',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'D3',
                'tanggal_lahir' => $now->copy()->subYears(30)->subMonths(7)->subDays(12)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Lintang Permata',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'D4/S1',
                'tanggal_lahir' => $now->copy()->subYears(37)->subMonths(10)->subDays(15)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Putra Rahman',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'S3',
                'tanggal_lahir' => $now->copy()->subYears(38)->subMonths(6)->subDays(22)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Tri Wahyuni',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'SMA/SMK',
                'tanggal_lahir' => $now->copy()->subYears(34)->subMonths(4)->subDays(7)->format('Y-m-d'),
            ],

            // Kelompok Usia 40–49 tahun
            [
                'nama_pegawai' => 'Bondan Witjaksono',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'D4/S1',
                'tanggal_lahir' => $now->copy()->subYears(42)->subMonths(8)->subDays(19)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Suharti',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'S2',
                'tanggal_lahir' => $now->copy()->subYears(45)->subMonths(2)->subDays(16)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Bambang Pamungkas',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'SMA/SMK',
                'tanggal_lahir' => $now->copy()->subYears(47)->subMonths(5)->subDays(30)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Endang Sulistyowati',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'D3',
                'tanggal_lahir' => $now->copy()->subYears(41)->subMonths(11)->subDays(9)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Joko Wibowo',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'SD',
                'tanggal_lahir' => $now->copy()->subYears(48)->subMonths(9)->subDays(13)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Puan Mahasantai',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'S3',
                'tanggal_lahir' => $now->copy()->subYears(44)->subMonths(7)->subDays(21)->format('Y-m-d'),
            ],

            // Kelompok Usia 50–59 tahun
            [
                'nama_pegawai' => 'Roy SuryaPro',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'D4/S1',
                'tanggal_lahir' => $now->copy()->subYears(52)->subMonths(3)->subDays(27)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Yeni Inka',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'D3',
                'tanggal_lahir' => $now->copy()->subYears(50)->subMonths(8)->subDays(4)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Prabowo Widodo',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'S2',
                'tanggal_lahir' => $now->copy()->subYears(55)->subMonths(1)->subDays(11)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Indah Kusuma',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'SMA/SMK',
                'tanggal_lahir' => $now->copy()->subYears(57)->subMonths(6)->subDays(23)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Buna Teddy',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'SMP',
                'tanggal_lahir' => $now->copy()->subYears(54)->subMonths(10)->subDays(18)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Suahasil Halal',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'D4/S1',
                'tanggal_lahir' => $now->copy()->subYears(58)->subMonths(4)->subDays(2)->format('Y-m-d'),
            ],

            // Kelompok Usia ≥ 60 tahun
            [
                'nama_pegawai' => 'Prof. Dr. H. Soedarmo',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'S3',
                'tanggal_lahir' => $now->copy()->subYears(63)->subMonths(5)->subDays(14)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Hj. Rohayati',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'S2',
                'tanggal_lahir' => $now->copy()->subYears(61)->subMonths(9)->subDays(28)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Gibran Rakagaming',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'SD',
                'tanggal_lahir' => $now->copy()->subYears(64)->subMonths(2)->subDays(17)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Veronica Tan',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'SMA/SMK',
                'tanggal_lahir' => $now->copy()->subYears(60)->subMonths(11)->subDays(6)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Drs. H. Hartono',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan_terakhir' => 'D4/S1',
                'tanggal_lahir' => $now->copy()->subYears(62)->subMonths(7)->subDays(15)->format('Y-m-d'),
            ],
            [
                'nama_pegawai' => 'Isyana Syaraswati',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan_terakhir' => 'D2',
                'tanggal_lahir' => $now->copy()->subYears(65)->subMonths(1)->subDays(20)->format('Y-m-d'),
            ],
        ];

        foreach ($sampleEmployees as $employee) {
            Employee::create($employee);
        }
    }
}
