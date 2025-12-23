<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mobil_id')->constrained('mobils')->onDelete('cascade');
            
            // Data Pemesanan
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('durasi'); // dalam hari
            $table->decimal('harga_per_hari', 15, 2);
            $table->decimal('total_harga', 15, 2);
            
            // Data Pelanggan
            $table->string('nama_lengkap');
            $table->string('nik', 16);
            $table->string('no_telepon', 15);
            $table->text('alamat');
            $table->string('foto_ktp');
            
            // Pembayaran
            $table->string('metode_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            
            // Status Pemesanan
            $table->enum('status', [
                'pending',      // Menunggu pembayaran
                'paid',         // Sudah bayar, menunggu konfirmasi admin
                'confirmed',    // Dikonfirmasi admin
                'active',       // Sedang berlangsung
                'completed',    // Selesai
                'cancelled'     // Dibatalkan
            ])->default('pending');
            
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};