<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PengembalianReminderNotification;
use Carbon\Carbon;

/**
 * Controller: AdminPengembalianController
 * 
 * Mengelola pengembalian mobil hari ini:
 * - Lihat daftar mobil yang harus dikembalikan hari ini
 * - Kirim reminder WhatsApp
 * - Kirim reminder Email
 * - Tandai sudah dikembalikan
 */
class AdminPengembalianController extends Controller
{
    /**
     * Method: Index - Tampilkan Daftar Pengembalian Hari Ini
     * 
     * Query: Pemesanan dengan status 'active' dan tanggal_selesai = hari ini
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Query pemesanan yang harus dikembalikan hari ini
        $query = Pemesanan::pengembalianHariIni();

        // Search berdasarkan nama penyewa
        if ($request->filled('search')) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
        }

        // Pagination
        $pengembalians = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Statistics
        $stats = [
            'total' => Pemesanan::pengembalianHariIni()->count(),
            'belum_reminder' => Pemesanan::pengembalianHariIni()->count(), // Semua perlu reminder
        ];

        return view('admin.pengembalian.index', compact('pengembalians', 'stats'));
    }

    /**
     * Method: Kirim WhatsApp Reminder
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
   public function sendWhatsApp($id, Request $request)
    {
        $pemesanan = Pemesanan::with(['user', 'mobil'])->findOrFail($id);

        if ($pemesanan->status !== 'active') {
            return redirect()->back()->with('error', 'Pemesanan tidak dalam status aktif.');
        }

        // Cek apakah ada parameter phone di query string
        $phoneNumber = $request->query('phone');
        
        // Generate URL WhatsApp reminder dengan nomor yang dipilih
        $whatsappUrl = $pemesanan->getReminderWhatsAppUrl($phoneNumber);

        return redirect()->away($whatsappUrl);
    }

    /**
     * Method: Kirim Email Reminder
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail($id)
    {
        $pemesanan = Pemesanan::with(['user', 'mobil'])->findOrFail($id);

        // Validasi status
        if ($pemesanan->status !== 'active') {
            return redirect()->back()->with('error', 'Pemesanan tidak dalam status aktif.');
        }

        // Validasi email
        if (!$pemesanan->canSendEmail()) {
            return redirect()->back()->with('error', 'Email pelanggan tidak tersedia.');
        }

        try {
            // Kirim email
            Mail::to($pemesanan->getCustomerEmail())
                ->send(new PengembalianReminderNotification($pemesanan));

            return redirect()->back()->with('success', 'Email reminder berhasil dikirim ke ' . $pemesanan->getCustomerEmail());

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    /**
     * Method: Tandai Sudah Dikembalikan
     * 
     * Update status jadi 'completed' dan mobil jadi 'Tersedia'
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsReturned($id)
    {
        $pemesanan = Pemesanan::with('mobil')->findOrFail($id);

        if ($pemesanan->status !== 'active') {
            return redirect()->back()->with('error', 'Pemesanan tidak dalam status aktif.');
        }

        // Update status pemesanan jadi completed
        $pemesanan->update(['status' => 'completed']);

        // Update status mobil jadi tersedia
        $pemesanan->mobil->update(['status' => 'Tersedia']);

        return redirect()->back()->with('success', 'Mobil berhasil ditandai sudah dikembalikan!');
    }
}