<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Model User merepresentasikan akun pengguna dan administrator aplikasi.
 *
 *
 * @property int $id Kunci primer pengguna
 * @property string $name Nama lengkap pengguna
 * @property string $email Alamat surel unik pengguna
 * @property Carbon|null $email_verified_at Waktu verifikasi surel
 * @property string $password Hash kata sandi pengguna
 * @property string|null $remember_token Token sesi masuk 'ingat saya'
 * @property Carbon|null $created_at Waktu pembuatan data pengguna
 * @property Carbon|null $updated_at Waktu terakhir data pengguna diperbarui
 */
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara mass-assignment.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi model.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mendapatkan atribut yang harus di-cast ke tipe data tertentu.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Menentukan apakah pengguna memiliki hak akses ke panel Filament yang diberikan.
     *
     * @param  Panel  $panel  Objek panel Filament yang sedang diakses
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
