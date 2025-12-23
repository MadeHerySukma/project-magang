<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mobil_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi',
        'harga_per_hari',
        'total_harga',
        'nama_lengkap',
        'nik',
        'no_telepon',
        'no_telepon_alternatif', // TAMBAHAN BARU
        'alamat',
        'foto_ktp',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status',
        'expired_at',
        'catatan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'expired_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    public function metodePembayaranDetail()
    {
        return $this->belongsTo(MetodePembayaran::class, 'metode_pembayaran', 'kode');
    }

    // Accessors
    public function getTotalHargaFormatAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getHargaPerHariFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga_per_hari, 0, ',', '.');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-500 text-white">⏳ Menunggu Pembayaran</span>',
            'paid' => '<span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-500 text-white">💳 Menunggu Konfirmasi</span>',
            'confirmed' => '<span class="px-3 py-1 text-xs font-bold rounded-full bg-green-500 text-white">✓ Dikonfirmasi</span>',
            'active' => '<span class="px-3 py-1 text-xs font-bold rounded-full bg-purple-500 text-white">🚗 Sedang Berlangsung</span>',
            'completed' => '<span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-500 text-white">✓ Selesai</span>',
            'cancelled' => '<span class="px-3 py-1 text-xs font-bold rounded-full bg-red-500 text-white">✗ Dibatalkan</span>',
        ];

        return $badges[$this->status] ?? $this->status;
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'active' => 'Sedang Berlangsung',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        return $texts[$this->status] ?? $this->status;
    }

    // Helpers
    public static function hitungDurasi($tanggalMulai, $tanggalSelesai)
    {
        $mulai = Carbon::parse($tanggalMulai);
        $selesai = Carbon::parse($tanggalSelesai);
        $durasi = $mulai->diffInDays($selesai);
        return max(1, $durasi);
    }

    public static function hitungTotalHarga($hargaPerHari, $durasi)
    {
        return $hargaPerHari * $durasi;
    }

    public function isExpired()
    {
        if (!$this->expired_at) {
            return false;
        }
        return $this->status === 'pending' && Carbon::now()->greaterThan($this->expired_at);
    }

    public function getRemainingSeconds()
    {
        if (!$this->expired_at || $this->status !== 'pending') {
            return 0;
        }
        $remaining = Carbon::now()->diffInSeconds($this->expired_at, false);
        return max(0, $remaining);
    }

    public function getFormattedRemainingTime()
    {
        $seconds = $this->getRemainingSeconds();
        if ($seconds <= 0) {
            return '00:00';
        }
        $minutes = floor($seconds / 60);
        $secs = $seconds % 60;
        return sprintf('%02d:%02d', $minutes, $secs);
    }

    // =============================================
    // FITUR BARU: DUAL PHONE NUMBER SUPPORT
    // =============================================

    /**
     * Cek apakah ada nomor telepon alternatif yang berbeda
     * 
     * @return bool
     */
    public function hasAlternativePhone()
    {
        return !empty($this->no_telepon_alternatif) && 
               $this->no_telepon_alternatif !== $this->no_telepon;
    }

    /**
     * Get semua nomor telepon yang tersedia
     * 
     * @return array
     */
    public function getAllPhones()
    {
        $phones = [
            'primary' => $this->no_telepon
        ];

        if ($this->hasAlternativePhone()) {
            $phones['alternative'] = $this->no_telepon_alternatif;
        }

        return $phones;
    }

    // =============================================
    // WHATSAPP NOTIFICATION - UPDATED
    // =============================================

    /**
     * Format nomor telepon untuk WhatsApp (62xxx)
     * 
     * @param string|null $phone - Nomor yang akan diformat
     * @return string
     */
    public function getWhatsAppNumber($phone = null)
    {
        // Jika tidak ada parameter, gunakan no_telepon utama
        if ($phone === null) {
            $phone = $this->no_telepon;
        }

        // Hapus semua karakter non-angka
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Jika diawali 0, ganti dengan 62
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // Jika belum ada 62 di depan, tambahkan
        if (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }

    /**
     * Generate pesan WhatsApp konfirmasi pemesanan
     */
    public function generateWhatsAppMessage()
    {
        $kode = '#' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
        $statusEmoji = $this->getStatusEmoji();
        
        $message = "🚗 *KONFIRMASI PEMESANAN RENTAL MOBIL*\n\n";
        $message .= "Kode Pemesanan: *{$kode}*\n";
        $message .= "Status: {$statusEmoji} *{$this->status_text}*\n\n";
        $message .= "Jika status sudah 'Dikonfirmasi' silahkan ambil mobil!!\n\n";
        
        $message .= "📋 *DETAIL PEMESANAN*\n";
        $message .= "• Mobil: {$this->mobil->merek} {$this->mobil->model}\n";
        $message .= "• Plat Nomor: {$this->mobil->plat_nomor}\n";
        $message .= "• Tipe: {$this->mobil->tipe}\n";
        $message .= "• Periode Sewa: {$this->tanggal_mulai->format('d M')} - {$this->tanggal_selesai->format('d M Y')}\n";
        $message .= "• Durasi: {$this->durasi} Hari\n";
        $message .= "• Harga/Hari: {$this->harga_per_hari_format}\n";
        $message .= "• Total Biaya: *{$this->total_harga_format}*\n\n";
        
        $message .= "📞 *INFORMASI PENYEWA*\n";
        $message .= "• Nama: {$this->nama_lengkap}\n";
        $message .= "• NIK: {$this->nik}\n";
        $message .= "• No. Telepon: {$this->no_telepon}\n";
        if ($this->hasAlternativePhone()) {
            $message .= "• No. Alternatif: {$this->no_telepon_alternatif}\n";
        }
        $message .= "• Alamat: {$this->alamat}\n\n";
        
        if ($this->metode_pembayaran) {
            $message .= "💳 *PEMBAYARAN*\n";
            $message .= "• Metode: " . strtoupper($this->metode_pembayaran) . "\n";
            
            if (in_array($this->status, ['paid', 'confirmed', 'active', 'completed'])) {
                $message .= "• Status: ✅ Sudah Dibayar\n\n";
            } else {
                $message .= "• Status: ⏳ Menunggu Pembayaran\n\n";
            }
        }
        
        if ($this->catatan) {
            $message .= "📝 *CATATAN*\n";
            $message .= $this->catatan . "\n\n";
        }
        
        $message .= "Terima kasih telah menggunakan layanan kami! 🙏";
        
        return $message;
    }

    private function getStatusEmoji()
    {
        $emojis = [
            'pending' => '⏳',
            'paid' => '💳',
            'confirmed' => '✅',
            'active' => '🚗',
            'completed' => '✓',
            'cancelled' => '❌',
        ];

        return $emojis[$this->status] ?? '📋';
    }

    /**
     * Generate URL WhatsApp dengan phone number spesifik
     * 
     * @param string|null $phoneNumber - Nomor telepon yang akan digunakan (null = primary)
     * @return string
     */
    public function getWhatsAppUrl($phoneNumber = null)
    {
        $phone = $this->getWhatsAppNumber($phoneNumber);
        $message = $this->generateWhatsAppMessage();
        $encodedMessage = urlencode($message);
        
        return "https://wa.me/{$phone}?text={$encodedMessage}";
    }

    // =============================================
    // EMAIL NOTIFICATION
    // =============================================

    public function getCustomerEmail()
    {
        if ($this->user && $this->user->email) {
            return $this->user->email;
        }
        return null;
    }

    public function canSendEmail()
    {
        return !is_null($this->getCustomerEmail());
    }

    // =============================================
    // PENGEMBALIAN MOBIL
    // =============================================

    public function scopePengembalianHariIni($query)
    {
        return $query->where('tanggal_selesai', Carbon::today())
                    ->where('status', 'active')
                    ->with(['user', 'mobil']);
    }

    public function generateReminderWhatsAppMessage()
    {
        $kode = '#' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
        
        $message = "⏰ *REMINDER PENGEMBALIAN MOBIL*\n\n";
        $message .= "Halo *{$this->nama_lengkap}*,\n\n";
        $message .= "Hari ini adalah hari terakhir masa sewa mobil Anda.\n\n";
        
        $message .= "📋 *DETAIL PEMESANAN*\n";
        $message .= "• Kode: *{$kode}*\n";
        $message .= "• Mobil: {$this->mobil->merek} {$this->mobil->model}\n";
        $message .= "• Plat Nomor: {$this->mobil->plat_nomor}\n";
        $message .= "• Periode: {$this->tanggal_mulai->format('d M')} - {$this->tanggal_selesai->format('d M Y')}\n";
        $message .= "• Durasi: {$this->durasi} Hari\n\n";
        
        $message .= "⏰ *WAKTU PENGEMBALIAN*\n";
        $message .= "• Tanggal: *HARI INI* ({$this->tanggal_selesai->format('d M Y')})\n";
        $message .= "• Deadline: Sebelum jam 18:00 WIB\n\n";
        
        $message .= "📍 *LOKASI PENGEMBALIAN*\n";
        $message .= "Jl. Raya Rental Mobil No. 123\n";
        $message .= "Jimbaran, Bali\n\n";
        
        $message .= "⚠️ *PENTING:*\n";
        $message .= "• Pastikan kondisi mobil bersih\n";
        $message .= "• BBM full tank (sesuai saat pengambilan)\n";
        $message .= "• Bawa dokumen pemesanan\n\n";
        
        if ($this->catatan) {
            $message .= "📝 *CATATAN:*\n";
            $message .= $this->catatan . "\n\n";
        }
        
        $message .= "Terima kasih telah menggunakan layanan kami! 🙏\n\n";
        $message .= "_Untuk info lebih lanjut, hubungi: 089976788788_";
        
        return $message;
    }

    /**
     * Generate URL WhatsApp reminder dengan phone number spesifik
     * 
     * @param string|null $phoneNumber - Nomor telepon yang akan digunakan
     * @return string
     */
    public function getReminderWhatsAppUrl($phoneNumber = null)
    {
        $phone = $this->getWhatsAppNumber($phoneNumber);
        $message = $this->generateReminderWhatsAppMessage();
        $encodedMessage = urlencode($message);
        
        return "https://wa.me/{$phone}?text={$encodedMessage}";
    }
}