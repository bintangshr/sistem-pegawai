<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\EmployeeFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<EmployeeFactory> */
    use HasFactory;

    /**
     * Pilihan jenis kelamin yang valid.
     *
     * @var array<string, string>
     */
    public const JENIS_KELAMIN_OPTIONS = [
        'Laki-laki' => 'Laki-laki',
        'Perempuan' => 'Perempuan',
    ];

    /**
     * Pilihan pendidikan terakhir yang valid (berurutan dari jenjang terendah ke tertinggi).
     *
     * @var array<string, string>
     */
    public const PENDIDIKAN_OPTIONS = [
        'SD' => 'SD',
        'SMP' => 'SMP',
        'SMA/SMK' => 'SMA/SMK',
        'D1' => 'D1',
        'D2' => 'D2',
        'D3' => 'D3',
        'D4/S1' => 'D4/S1',
        'S2' => 'S2',
        'S3' => 'S3',
    ];

    /**
     * Kolom yang dapat diisi secara mass-assignment.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_pegawai',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'tanggal_lahir',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    /**
     * Accessor untuk menghitung usia dalam tahun penuh berdasarkan tanggal lahir.
     */
    protected function usia(): Attribute
    {
        return Attribute::make(
            get: function (): ?int {
                if (! $this->tanggal_lahir) {
                    return null;
                }

                $birthDate = $this->tanggal_lahir instanceof Carbon
                    ? $this->tanggal_lahir
                    : Carbon::parse($this->tanggal_lahir);

                return $birthDate->age;
            }
        );
    }
}
