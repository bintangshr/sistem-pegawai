<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pegawai', 255);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('pendidikan_terakhir', [
                'SD',
                'SMP',
                'SMA/SMK',
                'D1',
                'D2',
                'D3',
                'D4/S1',
                'S2',
                'S3',
            ]);
            $table->date('tanggal_lahir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
