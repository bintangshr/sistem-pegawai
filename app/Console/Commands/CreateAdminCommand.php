<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin 
                            {--name= : Nama admin} 
                            {--email= : Email admin} 
                            {--password= : Kata sandi admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat akun administrator baru untuk panel Filament';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('=== Pembuatan Akun Administrator ===');

        $name = $this->option('name') ?? $this->ask('Nama Lengkap', 'Administrator');
        $email = $this->option('email');

        while (! $email) {
            $inputEmail = $this->ask('Alamat Email');
            $validator = Validator::make(['email' => $inputEmail], [
                'email' => ['required', 'email', 'unique:users,email'],
            ]);

            if ($validator->fails()) {
                $this->error($validator->errors()->first('email'));
            } else {
                $email = $inputEmail;
            }
        }

        $password = $this->option('password');
        while (! $password) {
            $inputPassword = $this->secret('Kata Sandi (minimal 6 karakter)');
            if (strlen($inputPassword) < 6) {
                $this->error('Kata sandi minimal harus 6 karakter.');
            } else {
                $password = $inputPassword;
            }
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->newLine();
        $this->info("✓ Akun administrator [{$user->email}] berhasil dibuat!");
        $this->info('Anda dapat langsung login melalui: /admin');

        return self::SUCCESS;
    }
}
