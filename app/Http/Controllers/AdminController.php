<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mobil;
use App\Models\Pemesanan;
use App\Models\WaitingList; // ← TAMBAHAN BARU
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // =============================================
        // FITUR BARU: PENGEMBALIAN HARI INI
        // =============================================

        // Total mobil yang harus dikembalikan hari ini
        $pengembalianHariIni = Pemesanan::where('tanggal_selesai', Carbon::today())
            ->where('status', 'active')
            ->with(['user', 'mobil'])
            ->get();

        $totalPengembalianHariIni = $pengembalianHariIni->count();

        // Statistik Users
        $totalUsers = User::count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        $totalAdmin = User::where('role', 'admin')->count();

        // Statistik Mobil
        $totalMobil = Mobil::count();
        $mobilTersedia = Mobil::where('status', 'Tersedia')->count();
        $mobilDisewa = Mobil::where('status', 'Disewa')->count();

        // Statistik Pemesanan
        $totalPemesanan = Pemesanan::count();
        $pemesananPending = Pemesanan::where('status', 'pending')->count();
        $pemesananPaid = Pemesanan::where('status', 'paid')->count(); // Menunggu konfirmasi
        $pemesananConfirmed = Pemesanan::where('status', 'confirmed')->count();
        $pemesananActive = Pemesanan::where('status', 'active')->count();
        $pemesananCompleted = Pemesanan::where('status', 'completed')->count();
        $pemesananCancelled = Pemesanan::where('status', 'cancelled')->count();

        // =============================================
        // PERUBAHAN: Total Pendapatan
        // HANYA dari status: confirmed, active, completed
        // TIDAK termasuk paid (belum dikonfirmasi admin)
        // =============================================
        $totalPendapatan = Pemesanan::whereIn('status', ['confirmed', 'active', 'completed'])
            ->sum('total_harga');

        // Pemesanan Terbaru (3 terakhir)
        $pemesananTerbaru = Pemesanan::with(['user', 'mobil'])
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        // Pemesanan yang perlu konfirmasi (status paid)
        $perluKonfirmasi = Pemesanan::with(['user', 'mobil'])
            ->where('status', 'paid')
            ->orderBy('created_at', 'desc')
            ->get();

        // =============================================
        // FITUR: STATISTIK PERIODIK
        // HANYA dari status: confirmed, active, completed
        // =============================================
        
        // Pendapatan Hari Ini
        $pendapatanHariIni = Pemesanan::whereIn('status', ['confirmed', 'active', 'completed'])
            ->whereDate('created_at', Carbon::today())
            ->sum('total_harga');
        
        // Transaksi Hari Ini
        $transaksiHariIni = Pemesanan::whereDate('created_at', Carbon::today())->count();
        
        // Pendapatan Minggu Ini
        $pendapatanMingguIni = Pemesanan::whereIn('status', ['confirmed', 'active', 'completed'])
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('total_harga');
        
        // Transaksi Minggu Ini
        $transaksiMingguIni = Pemesanan::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();
        
        // Pendapatan Bulan Ini
        $pendapatanBulanIni = Pemesanan::whereIn('status', ['confirmed', 'active', 'completed'])
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_harga');
        
        // Transaksi Bulan Ini
        $transaksiBulanIni = Pemesanan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        // Pendapatan Tahun Ini
        $pendapatanTahunIni = Pemesanan::whereIn('status', ['confirmed', 'active', 'completed'])
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_harga');
        
        // Transaksi Tahun Ini
        $transaksiTahunIni = Pemesanan::whereYear('created_at', Carbon::now()->year)
            ->count();

        // =============================================
        // FITUR: MOBIL TERLARIS (TOP 5)
        // HANYA dari status: confirmed, active, completed
        // =============================================
        $mobilTerlaris = Mobil::withCount([
                'pemesanans' => function($query) {
                    $query->whereIn('status', ['confirmed', 'active', 'completed']);
                }
            ])
            ->having('pemesanans_count', '>', 0)
            ->orderBy('pemesanans_count', 'desc')
            ->take(5)
            ->get();

        // =============================================
        // FITUR: DATA CHART PENDAPATAN 12 BULAN
        // HANYA dari status: confirmed, active, completed
        // =============================================
        $chartPendapatan = [];
        $chartLabels = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $chartLabels[] = $bulan->format('M Y');
            
            $pendapatan = Pemesanan::whereIn('status', ['confirmed', 'active', 'completed'])
                ->whereMonth('created_at', $bulan->month)
                ->whereYear('created_at', $bulan->year)
                ->sum('total_harga');
            
            $chartPendapatan[] = $pendapatan;
        }

        // =============================================
        // FITUR: PERBANDINGAN DENGAN PERIODE LALU
        // HANYA dari status: confirmed, active, completed
        // =============================================
        
        // Pendapatan Bulan Lalu
        $pendapatanBulanLalu = Pemesanan::whereIn('status', ['confirmed', 'active', 'completed'])
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('total_harga');
        
        // Persentase Pertumbuhan
        if ($pendapatanBulanLalu > 0) {
            $pertumbuhanPendapatan = (($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100;
        } else {
            $pertumbuhanPendapatan = $pendapatanBulanIni > 0 ? 100 : 0;
        }
        
        // Transaksi Bulan Lalu
        $transaksiBulanLalu = Pemesanan::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        
        // Pertumbuhan Transaksi
        if ($transaksiBulanLalu > 0) {
            $pertumbuhanTransaksi = (($transaksiBulanIni - $transaksiBulanLalu) / $transaksiBulanLalu) * 100;
        } else {
            $pertumbuhanTransaksi = $transaksiBulanIni > 0 ? 100 : 0;
        }

        // =============================================
        // FITUR BARU: STATISTIK WAITING LIST
        // =============================================
        
        // Total Waiting List (semua status)
        $totalWaitingList = WaitingList::count();
        
        // Waiting List yang masih menunggu
        $waitingListWaiting = WaitingList::where('status', 'waiting')->count();
        
        // Waiting List yang sudah dihubungi
        $waitingListNotified = WaitingList::where('status', 'notified')->count();
        
        // Waiting List yang dibatalkan
        $waitingListCancelled = WaitingList::where('status', 'cancelled')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalPelanggan',
            'totalAdmin',
            'totalMobil',
            'mobilTersedia',
            'mobilDisewa',
            'totalPemesanan',
            'pemesananPending',
            'pemesananPaid',
            'pemesananConfirmed',
            'pemesananActive',
            'pemesananCompleted',
            'pemesananCancelled',
            'totalPendapatan',
            'pemesananTerbaru',
            'perluKonfirmasi',
            // Data Baru
            'pendapatanHariIni',
            'transaksiHariIni',
            'pendapatanMingguIni',
            'transaksiMingguIni',
            'pendapatanBulanIni',
            'transaksiBulanIni',
            'pendapatanTahunIni',
            'transaksiTahunIni',
            'mobilTerlaris',
            'chartPendapatan',
            'chartLabels',
            'pendapatanBulanLalu',
            'pertumbuhanPendapatan',
            'transaksiBulanLalu',
            'pertumbuhanTransaksi',
            // ============================================
            // WAITING LIST (BARU)
            // ============================================
            'totalWaitingList',
            'waitingListWaiting',
            'waitingListNotified',
            'waitingListCancelled',
            'totalPengembalianHariIni',
            'pengembalianHariIni'
        ));
    }
}