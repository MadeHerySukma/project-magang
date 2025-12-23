<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\WaitingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WaitingListNotification;

/**
 * Controller: AdminWaitingListController
 * 
 * Mengelola waiting list dari sisi admin:
 * - Lihat daftar waiting list
 * - Filter berdasarkan mobil/status
 * - Kirim notifikasi WhatsApp ke waiting list
 * - Update status secara MANUAL (bukan otomatis)
 */
class AdminWaitingListController extends Controller
{
    /**
     * Method: Index - Tampilkan Daftar Waiting List
     * 
     * Admin bisa lihat semua waiting list dengan filter:
     * - Filter berdasarkan mobil
     * - Filter berdasarkan status (waiting/notified/cancelled)
     * - Search berdasarkan nama user
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Query dasar dengan relasi
        $query = WaitingList::with(['user', 'mobil'])
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan mobil
        if ($request->filled('mobil_id')) {
            $query->where('mobil_id', $request->mobil_id);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search berdasarkan nama user
        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('no_hp', 'like', '%' . $request->search . '%');
            });
        }

        // Pagination
        $waitingLists = $query->paginate(15)->withQueryString();

        // Data untuk filter dropdown
        $mobils = Mobil::orderBy('merek')->get();

        // Statistics
        $stats = [
            'total' => WaitingList::count(),
            'waiting' => WaitingList::where('status', 'waiting')->count(),
            'notified' => WaitingList::where('status', 'notified')->count(),
            'cancelled' => WaitingList::where('status', 'cancelled')->count(),
        ];

        return view('admin.waiting-list.index', compact('waitingLists', 'mobils', 'stats'));
    }

    /**
     * Method: Kirim WhatsApp ke Single User
     * 
     * Generate URL WhatsApp dengan pesan otomatis
     * untuk 1 user di waiting list
     * 
     * Flow:
     * 1. Get waiting list by ID
     * 2. Get user & mobil info
     * 3. Generate WhatsApp message
     * 4. Generate WhatsApp URL
     * 5. Redirect ke WhatsApp (TANPA update status)
     * 
     * PERUBAHAN: Status TIDAK otomatis jadi 'notified'
     * Admin harus klik tombol "Tandai Sudah Dihubungi" secara manual
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendWhatsApp($id)
    {
        // 1. GET WAITING LIST
        $waitingList = WaitingList::with(['user', 'mobil'])->findOrFail($id);
        $user = $waitingList->user;
        $mobil = $waitingList->mobil;

        // 2. VALIDASI NO HP
        if (!$user->no_hp) {
            return redirect()->back()->with('error', 'User tidak memiliki nomor HP/WhatsApp.');
        }

        // 3. GENERATE PESAN WHATSAPP
        $message = $this->generateWaitingListMessage($waitingList);

        // 4. FORMAT NOMOR HP (081234567890 -> 6281234567890)
        $phoneNumber = $this->formatPhoneNumber($user->no_hp);

        // 5. GENERATE URL WHATSAPP
        $whatsappUrl = "https://wa.me/{$phoneNumber}?text=" . urlencode($message);

        // ❌ DIHAPUS: $waitingList->markAsNotified();
        // Status TIDAK otomatis berubah, admin update manual

        // 6. REDIRECT KE WHATSAPP
        return redirect()->away($whatsappUrl);
    }

    /**
     * Method: Kirim WhatsApp ke Semua User untuk Mobil Tertentu
     * 
     * Admin bisa kirim WA ke semua user yang waiting untuk mobil tertentu
     * (Akan buka multiple tabs WhatsApp)
     * 
     * PERUBAHAN: Status TIDAK otomatis jadi 'notified'
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendWhatsAppBulk(Request $request)
    {
        $mobilId = $request->input('mobil_id');
        
        // Get semua waiting list untuk mobil ini yang masih waiting
        $waitingLists = WaitingList::with(['user', 'mobil'])
            ->where('mobil_id', $mobilId)
            ->where('status', 'waiting')
            ->get();

        if ($waitingLists->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada waiting list yang aktif untuk mobil ini.');
        }

        // Generate array URL WhatsApp untuk semua user
        $whatsappUrls = [];
        foreach ($waitingLists as $waitingList) {
            if ($waitingList->user->no_hp) {
                $message = $this->generateWaitingListMessage($waitingList);
                $phoneNumber = $this->formatPhoneNumber($waitingList->user->no_hp);
                $whatsappUrls[] = "https://wa.me/{$phoneNumber}?text=" . urlencode($message);
                
                // ❌ DIHAPUS: $waitingList->markAsNotified();
                // Status TIDAK otomatis berubah, admin update manual
            }
        }

        // Simpan URLs ke session untuk dibuka via JavaScript
        session()->flash('whatsapp_urls', $whatsappUrls);
        session()->flash('success', 'WhatsApp akan dibuka untuk ' . count($whatsappUrls) . ' user. Jangan lupa tandai sebagai "Sudah Dihubungi" setelah mengirim pesan!');

        return redirect()->back();
    }

    /**
     * Method: Update Status Waiting List (MANUAL)
     * 
     * Admin klik tombol untuk tandai sebagai "Sudah Dihubungi"
     * 
     * Flow:
     * 1. Get waiting list by ID
     * 2. Update status jadi 'notified'
     * 3. Update notified_at jadi sekarang
     * 4. Redirect back dengan success message
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsNotified($id)
    {
        $waitingList = WaitingList::findOrFail($id);
        
        // Update status jadi 'notified'
        $waitingList->markAsNotified();

        return redirect()->back()->with('success', 'Status berhasil diubah menjadi "Sudah Dihubungi".');
    }

    /**
     * Method: Hapus Waiting List
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $waitingList = WaitingList::findOrFail($id);
        $waitingList->delete();

        return redirect()->back()->with('success', 'Waiting list berhasil dihapus.');
    }

    /**
     * Helper: Generate Pesan WhatsApp
     * 
     * @param WaitingList $waitingList
     * @return string
     */
    private function generateWaitingListMessage(WaitingList $waitingList)
    {
        $user = $waitingList->user;
        $mobil = $waitingList->mobil;

        $message = "🚗 *KABAR GEMBIRA!* 🎉\n\n";
        $message .= "Halo *{$user->name}*,\n\n";
        $message .= "Mobil yang Anda tunggu sekarang *SUDAH TERSEDIA*! 🥳\n\n";
        $message .= "📋 *DETAIL MOBIL*\n";
        $message .= "• Mobil: *{$mobil->merek} {$mobil->model}*\n";
        $message .= "• Tipe: {$mobil->jenis}\n";
        $message .= "• Plat Nomor: {$mobil->nomor_plat}\n";
        $message .= "• Tahun: {$mobil->tahun}\n";
        $message .= "• Harga Sewa: *{$mobil->harga_format}/hari*\n\n";
        $message .= "🎯 *LANGKAH SELANJUTNYA:*\n";
        $message .= "1. Login ke akun Anda, dengan link : http://project-magang.test/login \n";
        $message .= "2. Pilih mobil ini\n";
        $message .= "3. Isi form pemesanan\n";
        $message .= "4. Lakukan pembayaran\n\n";
        $message .= "⚡ *Buruan sebelum kehabisan!*\n\n";
        $message .= "Terima kasih telah menunggu! 🙏\n\n";
        $message .= "_Pesan otomatis dari sistem Rental Mobil_";

        return $message;
    }

    /**
     * Helper: Format Nomor HP ke Format WhatsApp
     * 
     * Input: 081234567890 atau +6281234567890 atau 6281234567890
     * Output: 6281234567890
     * 
     * @param string $phoneNumber
     * @return string
     */
    private function formatPhoneNumber($phoneNumber)
    {
        // Hapus semua karakter non-digit
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Jika diawali 0, ganti dengan 62
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        }

        // Jika tidak diawali 62, tambahkan 62
        if (substr($phoneNumber, 0, 2) !== '62') {
            $phoneNumber = '62' . $phoneNumber;
        }

        return $phoneNumber;
    }

    /**
     * Method: Kirim Email ke Single User
     * 
     * Generate dan kirim email notifikasi bahwa mobil sudah tersedia
     * 
     * Flow:
     * 1. Get waiting list by ID
     * 2. Validasi apakah user punya email
     * 3. Kirim email menggunakan Laravel Mail
     * 4. Redirect back dengan success/error message
     * 
     * PERUBAHAN: Status TIDAK otomatis jadi 'notified'
     * Admin harus klik tombol "Tandai Sudah Dihubungi" secara manual
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail($id)
    {
        // 1. GET WAITING LIST
        $waitingList = WaitingList::with(['user', 'mobil'])->findOrFail($id);
        $user = $waitingList->user;

        // 2. VALIDASI EMAIL
        if (!$user->email) {
            return redirect()->back()->with('error', 'User tidak memiliki email yang terdaftar.');
        }

        // 3. KIRIM EMAIL
        try {
            Mail::to($user->email)
                ->send(new WaitingListNotification($waitingList));

            return redirect()->back()->with('success', 'Email berhasil dikirim ke ' . $user->email);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
}