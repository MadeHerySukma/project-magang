<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pemesanan;
use App\Models\Mobil;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CancelExpiredBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel expired bookings that have not been paid within 15 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Checking for expired bookings...');

        // Cari pemesanan dengan status pending yang sudah expired
        $expiredBookings = Pemesanan::where('status', 'pending')
            ->whereNotNull('expired_at')
            ->where('expired_at', '<=', Carbon::now())
            ->with('mobil')
            ->get();

        if ($expiredBookings->isEmpty()) {
            $this->info('✅ No expired bookings found.');
            Log::info('[Auto-Cancel] No expired bookings found at ' . Carbon::now());
            return Command::SUCCESS;
        }

        $cancelledCount = 0;

        foreach ($expiredBookings as $booking) {
            try {
                // Update status pemesanan menjadi cancelled
                $booking->update([
                    'status' => 'cancelled',
                    'catatan' => ($booking->catatan ? $booking->catatan . "\n" : '') . 
                                'Dibatalkan otomatis karena tidak melakukan pembayaran dalam 15 menit.'
                ]);

                // Update status mobil kembali menjadi Tersedia
                if ($booking->mobil && $booking->mobil->status === 'Disewa') {
                    $booking->mobil->update(['status' => 'Tersedia']);
                    $this->info("  ✓ Mobil '{$booking->mobil->merek} {$booking->mobil->model}' tersedia kembali");
                }

                $cancelledCount++;
                $this->warn("  ❌ Cancelled booking ID: {$booking->id} (Customer: {$booking->nama_lengkap})");
                
                Log::info("[Auto-Cancel] Booking ID {$booking->id} cancelled and car ID {$booking->mobil_id} is available again");
                
            } catch (\Exception $e) {
                $this->error("  ⚠️ Error cancelling booking ID {$booking->id}: " . $e->getMessage());
                Log::error("[Auto-Cancel] Error: " . $e->getMessage());
            }
        }

        $this->info("📊 Total cancelled bookings: {$cancelledCount}");
        Log::info("[Auto-Cancel] Total cancelled: {$cancelledCount} bookings");

        return Command::SUCCESS;
    }
}