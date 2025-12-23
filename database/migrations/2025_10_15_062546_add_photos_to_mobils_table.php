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
        Schema::table('mobils', function (Blueprint $table) {
            // Hapus kolom foto lama (jika ada)
            $table->dropColumn('foto');
            
            // Tambah 5 kolom foto baru
            $table->string('foto_depan')->nullable();
            $table->string('foto_belakang')->nullable();
            $table->string('foto_interior')->nullable();
            $table->string('foto_samping_kiri')->nullable();
            $table->string('foto_samping_kanan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mobils', function (Blueprint $table) {
            // Hapus 5 kolom foto
            $table->dropColumn([
                'foto_depan', 
                'foto_belakang', 
                'foto_interior',
                'foto_samping_kiri',
                'foto_samping_kanan'
            ]);
            
            // Kembalikan kolom foto lama
            $table->string('foto')->nullable();
        });
    }
};