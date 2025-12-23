<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Tambah Kolom no_telepon_alternatif ke Table Pemesanans
 * 
 * Fungsi:
 * - Menambahkan kolom untuk nomor telepon alternatif (opsional)
 * - User bisa input nomor HP lain selain yang terdaftar saat registrasi
 * - Berguna untuk kontak darurat atau nomor keluarga
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            // Tambah kolom no_telepon_alternatif setelah no_telepon
            // Nullable karena opsional (tidak wajib diisi)
            $table->string('no_telepon_alternatif', 15)
                  ->nullable()
                  ->after('no_telepon')
                  ->comment('Nomor telepon alternatif pelanggan (opsional)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn('no_telepon_alternatif');
        });
    }
};