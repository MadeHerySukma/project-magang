<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Mail\PemesananNotification;
use Illuminate\Support\Facades\Mail;

class AdminPemesananController extends Controller
{
    // Daftar semua pemesanan
    public function index(Request $request)
    {
        $query = Pemesanan::with(['user', 'mobil']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('id', 'like', '%' . $request->search . '%');
            });
        }

        $pemesanans = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    // Detail pemesanan
    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'mobil'])->findOrFail($id);
        return view('admin.pemesanan.show', compact('pemesanan'));
    }
  
    // Konfirmasi pembayaran
    public function konfirmasi($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        if ($pemesanan->status !== 'paid') {
            return back()->with('error', 'Pemesanan tidak dapat dikonfirmasi.');
        }

        $pemesanan->update(['status' => 'confirmed']);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    // Mulai sewa (status menjadi active)
    public function mulaiSewa($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        if ($pemesanan->status !== 'confirmed') {
            return back()->with('error', 'Pemesanan belum dikonfirmasi.');
        }

        $pemesanan->update(['status' => 'active']);

        return back()->with('success', 'Sewa dimulai! Status diubah menjadi aktif.');
    }

    // Selesaikan sewa
    public function selesaikan($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        if ($pemesanan->status !== 'active') {
            return back()->with('error', 'Sewa belum dimulai atau sudah selesai.');
        }

        $pemesanan->update(['status' => 'completed']);

        $pemesanan->mobil->update(['status' => 'Tersedia']);

        return back()->with('success', 'Sewa selesai! Mobil tersedia untuk disewa kembali.');
    }

    // Batalkan pemesanan
    public function batal($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        if (in_array($pemesanan->status, ['completed', 'cancelled'])) {
            return back()->with('error', 'Pemesanan tidak dapat dibatalkan.');
        }

        $pemesanan->update(['status' => 'cancelled']);

        $pemesanan->mobil->update(['status' => 'Tersedia']);

        return back()->with('success', 'Pemesanan dibatalkan.');
    }

    // Tolak pembayaran
    public function tolakPembayaran($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        if ($pemesanan->status !== 'paid') {
            return back()->with('error', 'Pemesanan tidak dalam status menunggu konfirmasi.');
        }

        $pemesanan->update([
            'status' => 'pending',
            'bukti_pembayaran' => null,
        ]);

        return back()->with('success', 'Pembayaran ditolak. Pelanggan perlu upload ulang bukti pembayaran.');
    }

    // =============================================
    // FITUR BARU: KIRIM NOTIFIKASI WHATSAPP (UPDATED DENGAN DUAL PHONE)
    // =============================================
    
    /**
     * Kirim notifikasi konfirmasi ke WhatsApp pelanggan
     * 
     * UPDATED: Sekarang bisa kirim ke nomor alternatif via parameter ?phone=xxx
     * 
     * @param int $id - ID pemesanan
     * @param Request $request - Untuk ambil parameter phone (optional)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kirimWhatsApp($id, Request $request)
    {
        $pemesanan = Pemesanan::with(['user', 'mobil'])->findOrFail($id);
        
        // Cek apakah ada parameter phone di query string
        // Jika ada, gunakan nomor tersebut. Jika tidak, gunakan nomor utama
        $phoneNumber = $request->query('phone');
        
        // Generate URL WhatsApp dengan nomor yang dipilih
        $whatsappUrl = $pemesanan->getWhatsAppUrl($phoneNumber);
        
        return redirect()->away($whatsappUrl);
    }

    // =============================================
    // FITUR BARU: KIRIM NOTIFIKASI EMAIL
    // =============================================
    
    /**
     * Kirim notifikasi konfirmasi via Email ke pelanggan
     * 
     * @param int $id - ID pemesanan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kirimEmail($id)
    {
        $pemesanan = Pemesanan::with(['user', 'mobil'])->findOrFail($id);
        
        if (!$pemesanan->canSendEmail()) {
            return back()->with('error', 'Email pelanggan tidak tersedia. Tidak dapat mengirim notifikasi.');
        }
        
        try {
            Mail::to($pemesanan->getCustomerEmail())
                ->send(new PemesananNotification($pemesanan));
            
            return back()->with('success', 'Email notifikasi berhasil dikirim ke ' . $pemesanan->getCustomerEmail());
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
}