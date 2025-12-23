<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('merek'); // Toyota, Honda, dll
            $table->string('model'); // Avanza, Jazz, dll
            $table->enum('jenis', ['Sedan', 'SUV', 'MPV', 'Hatchback', 'Pickup']); // Jenis mobil
            $table->string('nomor_plat')->unique(); // B 1234 XYZ
            $table->integer('tahun'); // 2020, 2021, dll
            $table->decimal('harga_sewa', 10, 2); // Harga per hari
            $table->enum('status', ['Tersedia', 'Disewa', 'Dalam Perawatan'])->default('Tersedia');
            $table->text('deskripsi')->nullable(); // Deskripsi tambahan
            $table->string('foto')->nullable(); // Path foto mobil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};