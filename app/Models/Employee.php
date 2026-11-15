<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\EmployeeFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Employee merepresentasikan entitas data pegawai di dalam sistem.
 *
 *
 * @property int $id Kunci primer data pegawai
 * @property string $nama_pegawai Nama lengkap pegawai
 * @property string $jenis_kelamin Jenis kelamin pegawai ('Laki-laki'|'Perempuan')
 * @property string $pendidikan_terakhir Jenjang pendidikan terakhir pegawai
 * @property Carbon|null $tanggal_lahir Tanggal lahir pegawai
 * @property \Illuminate\Support\Carbon|null $created_at Waktu pembuatan data
 * @property \Illuminate\Support\Carbon|null $updated_at Waktu terakhir data diperbarui
 * @property-read int|null $usia Usia pegawai dalam tahun yang dihitung secara dinamis dari tanggal lahir
 */
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
     *
     * @return Attribute<int|null, never>
     */
    protected function usia(): Attribute
    {
        return Attribute::make(
            get: function (): ?int {
                if (! $this->tanggal_lahir) {
                    return null;
                }

                // Menghitung usia dinamis dalam tahun penuh menggunakan selisih waktu Carbon dari tanggal lahir ke hari ini.
                $birthDate = $this->tanggal_lahir instanceof Carbon
                    ? $this->tanggal_lahir
                    : Carbon::parse($this->tanggal_lahir);

                return $birthDate->age;
            }
        );
    }
}
