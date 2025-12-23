<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Tambah Kolom no_hp ke Table Users
 * 
 * Untuk sistem Waiting List, kita perlu nomor HP/WA user
 * agar admin bisa kirim notifikasi WhatsApp
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom no_hp setelah kolom email
            // Nullable karena user lama mungkin belum punya no HP
            $table->string('no_hp', 20)->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('no_hp');
        });
    }
};