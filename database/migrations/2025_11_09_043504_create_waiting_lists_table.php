<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create Waiting Lists Table
 * 
 * Table untuk menyimpan data pelanggan yang join waiting list
 * untuk mobil yang sedang tidak tersedia
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('waiting_lists', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke users
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            
            // Foreign key ke mobils
            $table->foreignId('mobil_id')
                ->constrained('mobils')
                ->onDelete('cascade');
            
            // Status waiting list
            // waiting: masih menunggu
            // notified: sudah dikirim notifikasi WA
            // cancelled: user membatalkan
            $table->enum('status', ['waiting', 'notified', 'cancelled'])
                ->default('waiting');
            
            // Timestamp kapan notifikasi dikirim
            $table->timestamp('notified_at')->nullable();
            
            // Catatan admin (opsional)
            $table->text('admin_note')->nullable();
            
            $table->timestamps();
            
            // Index untuk query cepat
            $table->index(['mobil_id', 'status']);
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waiting_lists');
    }
};