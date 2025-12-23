<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AdminMobilController;
use App\Http\Controllers\AdminPemesananController;
use App\Http\Controllers\PelangganMobilController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminSettingController;

// =============================================
// LANDING PAGE - ROUTE BARU
// =============================================
Route::get('/', [AdminHomeController::class, 'index'])->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Manajemen Mobil
    Route::prefix('mobil')->name('mobil.')->group(function () {
        Route::get('/', [AdminMobilController::class, 'index'])->name('index');
        Route::post('/', [AdminMobilController::class, 'store'])->name('store');
        Route::put('/{id}', [AdminMobilController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminMobilController::class, 'destroy'])->name('destroy');
    });

    // transaksi dan struk
    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('index');
        Route::get('/struk/{id}', [TransaksiController::class, 'struk'])->name('struk');
        Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('laporan');
    });

    // Manajemen Pemesanan
    Route::prefix('pemesanan')->name('pemesanan.')->group(function () {
        Route::get('/', [AdminPemesananController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminPemesananController::class, 'show'])->name('show');
        Route::post('/{id}/konfirmasi', [AdminPemesananController::class, 'konfirmasi'])->name('konfirmasi');
        Route::post('/{id}/tolak', [AdminPemesananController::class, 'tolakPembayaran'])->name('tolak');
        Route::post('/{id}/mulai', [AdminPemesananController::class, 'mulaiSewa'])->name('mulai');
        Route::post('/{id}/selesai', [AdminPemesananController::class, 'selesaikan'])->name('selesai');
        Route::post('/{id}/batal', [AdminPemesananController::class, 'batal'])->name('batal');
        
        // =============================================
        // ROUTE BARU: WHATSAPP NOTIFICATION
        // =============================================
        /**
         * Route untuk kirim notifikasi WhatsApp ke pelanggan
         * 
         * Method: GET (karena ini redirect, bukan form submission)
         * URL: /admin/pemesanan/{id}/whatsapp
         * Name: admin.pemesanan.whatsapp
         * 
         * Cara pakai di blade:
         * <a href="{{ route('admin.pemesanan.whatsapp', $pemesanan->id) }}">
         *     Kirim ke WhatsApp
         * </a>
         * 
         * Flow:
         * 1. Admin klik tombol "Kirim ke WhatsApp"
         * 2. Browser hit URL ini dengan ID pemesanan
         * 3. Controller method kirimWhatsApp() dijalankan
         * 4. Generate URL WhatsApp dengan pesan otomatis
         * 5. Browser redirect ke WhatsApp (web.whatsapp.com atau app)
         */
        Route::get('/{id}/whatsapp', [AdminPemesananController::class, 'kirimWhatsApp'])
            ->name('whatsapp');
        // Route untuk kirim email
        Route::get('/{id}/email', [AdminPemesananController::class, 'kirimEmail'])
            ->name('email');
    });

    // Manajemen User
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminUserController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminUserController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [AdminSettingController::class, 'index'])->name('index');
        Route::put('/update', [AdminSettingController::class, 'update'])->name('update');
    });
});

// Pelanggan Routes
Route::middleware('auth')->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [PelangganController::class, 'dashboard'])->name('dashboard');
    
    // Lihat Mobil
    Route::prefix('mobil')->name('mobil.')->group(function () {
        Route::get('/', [PelangganMobilController::class, 'index'])->name('index');
        Route::get('/{id}', [PelangganMobilController::class, 'show'])->name('show');
    });

    // Pemesanan
    Route::prefix('pemesanan')->name('pemesanan.')->group(function () {
        Route::get('/', [PemesananController::class, 'index'])->name('index');
        Route::get('/create/{mobil_id}', [PemesananController::class, 'create'])->name('create');
        Route::post('/', [PemesananController::class, 'store'])->name('store');
        Route::get('/{id}', [PemesananController::class, 'show'])->name('show');
        Route::get('/{id}/payment', [PemesananController::class, 'payment'])->name('payment');
        Route::post('/{id}/upload-bukti', [PemesananController::class, 'uploadBukti'])->name('upload-bukti');
    });
});

// =============================================
// CUSTOMER WAITING LIST ROUTES (PUBLIC)
// =============================================
Route::prefix('waiting-list')->name('waiting-list.')->group(function () {
    // ============================================
    // ROUTE BARU: CHECK STATUS (API ENDPOINT)
    // ============================================
    /**
     * API Endpoint untuk cek status waiting list
     * 
     * Method: POST
     * URL: /waiting-list/check-status
     * Name: waiting-list.check-status
     * 
     * Request Body:
     * - email (required)
     * - mobil_id (required)
     * 
     * Response: JSON
     * {
     *   "registered": true/false,
     *   "user_exists": true/false,
     *   "message": "...",
     *   "data": {...}
     * }
     * 
     * Cara pakai via JavaScript:
     * fetch('/waiting-list/check-status', {
     *   method: 'POST',
     *   headers: {
     *     'Content-Type': 'application/json',
     *     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
     *   },
     *   body: JSON.stringify({
     *     email: emailValue,
     *     mobil_id: mobilIdValue
     *   })
     * })
     */
    Route::post('/check-status', [App\Http\Controllers\WaitingListController::class, 'checkStatus'])
        ->name('check-status');

    /**
     * Submit form waiting list
     * 
     * Method: POST
     * URL: /waiting-list/join
     * Name: waiting-list.store
     */
    Route::post('/join', [App\Http\Controllers\WaitingListController::class, 'store'])
        ->name('store');
});

// =============================================
// ADMIN WAITING LIST ROUTES (PROTECTED)
// =============================================
Route::middleware('auth')->prefix('admin/waiting-list')->name('admin.waiting-list.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminWaitingListController::class, 'index'])
        ->name('index');
    Route::get('/{id}/send-whatsapp', [App\Http\Controllers\AdminWaitingListController::class, 'sendWhatsApp'])
        ->name('send-whatsapp');
    Route::post('/send-whatsapp-bulk', [App\Http\Controllers\AdminWaitingListController::class, 'sendWhatsAppBulk'])
        ->name('send-whatsapp-bulk');
    Route::post('/{id}/mark-as-notified', [App\Http\Controllers\AdminWaitingListController::class, 'markAsNotified'])
        ->name('mark-as-notified');
    Route::delete('/{id}', [App\Http\Controllers\AdminWaitingListController::class, 'destroy'])
        ->name('destroy');
    Route::get('/{id}/send-email', [App\Http\Controllers\AdminWaitingListController::class, 'sendEmail'])
        ->name('send-email');
        
});

// =============================================
// ADMIN PENGEMBALIAN ROUTES (BARU)
// =============================================
Route::middleware('auth')->prefix('admin/pengembalian')->name('admin.pengembalian.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminPengembalianController::class, 'index'])
        ->name('index');
    Route::get('/{id}/send-whatsapp', [App\Http\Controllers\AdminPengembalianController::class, 'sendWhatsApp'])
        ->name('send-whatsapp');
    Route::get('/{id}/send-email', [App\Http\Controllers\AdminPengembalianController::class, 'sendEmail'])
        ->name('send-email');
    Route::post('/{id}/mark-as-returned', [App\Http\Controllers\AdminPengembalianController::class, 'markAsReturned'])
        ->name('mark-as-returned');
});