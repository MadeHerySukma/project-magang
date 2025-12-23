<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemesanan::with(['user', 'mobil']);

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->whereHas('user', function($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('mobil', function($query) use ($request) {
                    $query->where('merek', 'like', '%' . $request->search . '%')
                          ->orWhere('model', 'like', '%' . $request->search . '%');
                });
            });
        }

        // Filter Bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Filter Tahun
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Metode Pembayaran
        if ($request->filled('metode_pembayaran')) {
            $query->where('metode_pembayaran', $request->metode_pembayaran);
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort == 'terbaru') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort == 'terlama') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort == 'total_desc') {
            $query->orderBy('total_harga', 'desc');
        } elseif ($sort == 'total_asc') {
            $query->orderBy('total_harga', 'asc');
        }

        $transaksis = $query->paginate(10)->withQueryString();

        // Data untuk dropdown filter
        $bulan_list = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        $tahun_list = Pemesanan::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // ✅ Ambil metode pembayaran yang unik dari database
        $metode_list = Pemesanan::distinct()
            ->whereNotNull('metode_pembayaran')
            ->orderBy('metode_pembayaran', 'asc')
            ->pluck('metode_pembayaran');

        // ✅ Mapping untuk tampilan yang lebih readable
        $metode_display = [
            'transfer_bca' => 'Transfer BCA',
            'transfer_bni' => 'Transfer BNI',
            'transfer_mandiri' => 'Transfer Mandiri',
            'va_bca' => 'Virtual Account BCA',
            'va_bni' => 'Virtual Account BNI',
            'va_mandiri' => 'Virtual Account Mandiri',
        ];

        return view('admin.transaksi.index', compact(
            'transaksis', 
            'bulan_list', 
            'tahun_list',
            'metode_list',
            'metode_display'
        ));
    }

    public function struk($id)
    {
        $transaksi = Pemesanan::with(['user', 'mobil'])->findOrFail($id);
        
        return view('admin.transaksi.struk', compact('transaksi'));
    }

    public function laporan(Request $request)
    {
        // =============================================
        // FITUR BARU: Filter Harian, Mingguan, Bulanan
        // =============================================
        $tipe_periode = $request->get('tipe_periode', 'bulanan');
        $tanggal = $request->get('tanggal', date('Y-m-d'));
        $minggu = $request->get('minggu', date('Y-\WW'));
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));

        // Ambil SEMUA transaksi dalam periode untuk perhitungan summary
        $query = Pemesanan::with(['user', 'mobil']);

        // Filter berdasarkan tipe periode
        if ($tipe_periode == 'harian') {
            $query->whereDate('created_at', $tanggal);
        } elseif ($tipe_periode == 'mingguan') {
            // Parse minggu dari format Y-W (contoh: 2025-W01)
            $year = substr($minggu, 0, 4);
            $week = substr($minggu, 6, 2);
            
            // Hitung tanggal awal dan akhir minggu
            $startOfWeek = Carbon::now()->setISODate($year, $week)->startOfWeek();
            $endOfWeek = Carbon::now()->setISODate($year, $week)->endOfWeek();
            
            $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        } else {
            // Default: Bulanan
            $query->whereMonth('created_at', $bulan)
                  ->whereYear('created_at', $tahun);
        }

        $all_transaksis = $query->orderBy('created_at', 'desc')->get();

        $total_transaksi = $all_transaksis->count();
        
        // =============================================
        // PERUBAHAN: Filter transaksi yang SUDAH DIKONFIRMASI ADMIN
        // Status yang masuk pendapatan: confirmed, active, completed
        // TIDAK termasuk paid (bukti pembayaran belum dicek/dikonfirmasi)
        // Alasan: Bukti bayar bisa palsu, harus dicek manual dulu
        // =============================================
        $transaksis_terkonfirmasi = $all_transaksis->whereIn('status', ['confirmed', 'active', 'completed']);
        $total_transaksi_terkonfirmasi = $transaksis_terkonfirmasi->count();
        
        // Hitung pendapatan dari transaksi yang sudah dikonfirmasi admin
        $total_pendapatan = $transaksis_terkonfirmasi->sum('total_harga');
        
        // Breakdown per status (dari SEMUA transaksi)
        $per_status = $all_transaksis->groupBy('status')->map(function($items) {
            return [
                'jumlah' => $items->count(),
                'total' => $items->sum('total_harga')
            ];
        });

        // Breakdown per metode (dari transaksi yang sudah dikonfirmasi admin)
        $per_metode = $transaksis_terkonfirmasi->groupBy('metode_pembayaran')->map(function($items) {
            return [
                'jumlah' => $items->count(),
                'total' => $items->sum('total_harga')
            ];
        });

        // Ambil transaksi dengan pagination untuk tabel detail
        $query_paginate = Pemesanan::with(['user', 'mobil']);

        // Filter berdasarkan tipe periode (sama seperti di atas)
        if ($tipe_periode == 'harian') {
            $query_paginate->whereDate('created_at', $tanggal);
        } elseif ($tipe_periode == 'mingguan') {
            $year = substr($minggu, 0, 4);
            $week = substr($minggu, 6, 2);
            $startOfWeek = Carbon::now()->setISODate($year, $week)->startOfWeek();
            $endOfWeek = Carbon::now()->setISODate($year, $week)->endOfWeek();
            $query_paginate->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        } else {
            $query_paginate->whereMonth('created_at', $bulan)
                          ->whereYear('created_at', $tahun);
        }

        $transaksis = $query_paginate->orderBy('created_at', 'desc')
                                    ->paginate(10)
                                    ->withQueryString();

        $bulan_list = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        $tahun_list = Pemesanan::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('admin.transaksi.laporan', compact(
            'transaksis',
            'total_transaksi',
            'total_transaksi_terkonfirmasi',
            'total_pendapatan',
            'per_status',
            'per_metode',
            'tipe_periode',
            'tanggal',
            'minggu',
            'bulan', 
            'tahun',
            'bulan_list',
            'tahun_list'
        ));
    }
}