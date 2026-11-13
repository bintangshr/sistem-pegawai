<?php

namespace Database\Factories;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Employee>
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisKelamin = fake()->randomElement(['Laki-laki', 'Perempuan']);
        $genderParam = $jenisKelamin === 'Laki-laki' ? 'male' : 'female';

        // Variasi usia dari 18 hingga 65 tahun agar mencakup seluruh kategori usia
        $age = fake()->randomElement([
            fake()->numberBetween(18, 19), // <20
            fake()->numberBetween(20, 29), // 20–29
            fake()->numberBetween(30, 39), // 30–39
            fake()->numberBetween(40, 49), // 40–49
            fake()->numberBetween(50, 59), // 50–59
            fake()->numberBetween(60, 65), // ≥60
        ]);

        $tanggalLahir = Carbon::now()->subYears($age)->subDays(fake()->numberBetween(0, 360))->format('Y-m-d');

        return [
            'nama_pegawai' => fake('id_ID')->name($genderParam),
            'jenis_kelamin' => $jenisKelamin,
            'pendidikan_terakhir' => fake()->randomElement(array_keys(Employee::PENDIDIKAN_OPTIONS)),
            'tanggal_lahir' => $tanggalLahir,
        ];
    }
}
