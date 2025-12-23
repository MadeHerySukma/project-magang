<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pemesanan;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PemesananController extends Controller
{
    // Daftar pemesanan pelanggan
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        $query = Pemesanan::where('user_id', $user->id)->with('mobil');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $pemesanans = $query->orderBy('created_at', 'desc')->get();

        return view('pelanggan.pemesanan.index', compact('pemesanans'));
    }

    // Form pemesanan baru
    public function create($mobil_id)
    {
        $mobil = Mobil::findOrFail($mobil_id);

        if ($mobil->status !== 'Tersedia') {
            return redirect()->route('pelanggan.mobil.index')
                ->with('error', 'Mobil tidak tersedia untuk disewa.');
        }

        return view('pelanggan.pemesanan.create', compact('mobil'));
    }

    // Simpan pemesanan baru - UPDATED DENGAN DUAL PHONE
    public function store(Request $request)
    {
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'no_telepon' => 'required|string|max:15|regex:/^[0-9]+$/',
            'no_telepon_alternatif' => 'nullable|string|max:15|regex:/^[0-9]+$/', // TAMBAHAN BARU
            'alamat' => 'required|string',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string',
        ], [
            'tanggal_mulai.after_or_equal' => 'Tanggal mulai tidak boleh kurang dari hari ini.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'no_telepon.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'no_telepon_alternatif.regex' => 'Nomor telepon alternatif hanya boleh berisi angka.',
            'foto_ktp.required' => 'Foto KTP wajib diunggah.',
            'foto_ktp.image' => 'File harus berupa gambar.',
            'foto_ktp.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'foto_ktp.max' => 'Ukuran file maksimal 2MB.',
        ]);

        $mobil = Mobil::findOrFail($request->mobil_id);

        if ($mobil->status !== 'Tersedia') {
            return back()->with('error', 'Mobil tidak tersedia untuk disewa.');
        }

        if (empty($mobil->harga_sewa) || $mobil->harga_sewa <= 0) {
            return back()->with('error', 'Data harga mobil tidak valid. Silakan hubungi admin.');
        }

        $konflikPemesanan = Pemesanan::where('mobil_id', $request->mobil_id)
            ->whereIn('status', ['pending', 'paid', 'confirmed', 'active'])
            ->where(function($query) use ($request) {
                $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                    ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                    ->orWhere(function($q) use ($request) {
                        $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                          ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                    });
            })
            ->exists();

        if ($konflikPemesanan) {
            return back()->with('error', 'Mobil sudah dipesan pada tanggal tersebut. Silakan pilih tanggal lain.');
        }

        $fotoKtpPath = $request->file('foto_ktp')->store('ktp', 'public');

        $durasi = Pemesanan::hitungDurasi($request->tanggal_mulai, $request->tanggal_selesai);
        $totalHarga = Pemesanan::hitungTotalHarga($mobil->harga_sewa, $durasi);

        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        $pemesanan = Pemesanan::create([
            'user_id' => $user->id,
            'mobil_id' => $request->mobil_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'durasi' => $durasi,
            'harga_per_hari' => $mobil->harga_sewa,
            'total_harga' => $totalHarga,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'no_telepon' => $request->no_telepon,
            'no_telepon_alternatif' => $request->no_telepon_alternatif, // TAMBAHAN BARU
            'alamat' => $request->alamat,
            'foto_ktp' => $fotoKtpPath,
            'catatan' => $request->catatan,
            'status' => 'pending',
            'expired_at' => now()->addMinutes(15),
        ]);

        $mobil->update(['status' => 'Disewa']);

        return redirect()->route('pelanggan.pemesanan.payment', $pemesanan->id)
            ->with('success', 'Pemesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    // Detail pemesanan
    public function show($id)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        $pemesanan = Pemesanan::with('mobil')
            ->where('user_id', $user->id)
            ->findOrFail($id);

        return view('pelanggan.pemesanan.show', compact('pemesanan'));
    }

    // Halaman pembayaran
    public function payment($id)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        $pemesanan = Pemesanan::with('mobil')
            ->where('user_id', $user->id)
            ->findOrFail($id);

        if ($pemesanan->isExpired()) {
            $pemesanan->update([
                'status' => 'cancelled',
                'catatan' => ($pemesanan->catatan ? $pemesanan->catatan . "\n" : '') . 
                            'Dibatalkan otomatis karena tidak melakukan pembayaran dalam 15 menit.'
            ]);

            $pemesanan->mobil->update(['status' => 'Tersedia']);

            return redirect()->route('pelanggan.pemesanan.index')
                ->with('error', '⏰ Waktu pembayaran telah habis. Pemesanan Anda dibatalkan otomatis.');
        }

        if ($pemesanan->status !== 'pending') {
            return redirect()->route('pelanggan.pemesanan.show', $pemesanan->id);
        }

        $metodePembayarans = MetodePembayaran::active()
            ->orderBy('urutan')
            ->get();

        return view('pelanggan.pemesanan.payment', compact('pemesanan', 'metodePembayarans'));
    }

    // Upload bukti pembayaran
    public function uploadBukti(Request $request, $id)
    {
        $metodePembayaranKodes = MetodePembayaran::active()->pluck('kode')->toArray();
        
        $request->validate([
            'metode_pembayaran' => ['required', 'in:' . implode(',', $metodePembayaranKodes)],
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'metode_pembayaran.required' => 'Pilih metode pembayaran.',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid.',
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diunggah.',
            'bukti_pembayaran.image' => 'File harus berupa gambar.',
            'bukti_pembayaran.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'bukti_pembayaran.max' => 'Ukuran file maksimal 2MB.',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        $pemesanan = Pemesanan::where('user_id', $user->id)
            ->findOrFail($id);

        if ($pemesanan->status !== 'pending') {
            return back()->with('error', 'Pemesanan ini tidak dapat diubah.');
        }

        $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $pemesanan->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $buktiPath,
            'status' => 'paid',
        ]);

        return redirect()->route('pelanggan.pemesanan.show', $pemesanan->id)
            ->with('success', 'Bukti pembayaran berhasil diunggah! Menunggu konfirmasi admin.');
    }
}