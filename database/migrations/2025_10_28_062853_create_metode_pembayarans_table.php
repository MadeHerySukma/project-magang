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
        Schema::create('metode_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_metode'); // Transfer Bank BCA, E-Wallet DANA, dll
            $table->string('kode')->unique(); // transfer_bca, dana, gopay, dll
            $table->enum('tipe', ['bank', 'ewallet']); // Tipe: Bank atau E-Wallet
            $table->string('nama_penerima'); // BCA, DANA, OVO, dll
            $table->string('nomor_rekening'); // Nomor rekening atau nomor e-wallet
            $table->string('atas_nama'); // Nama pemilik rekening
            $table->string('logo')->nullable(); // Path logo (opsional)
            $table->text('instruksi')->nullable(); // Instruksi pembayaran (opsional)
            $table->boolean('is_active')->default(true); // Status aktif/nonaktif
            $table->integer('urutan')->default(0); // Urutan tampil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metode_pembayarans');
    }
};