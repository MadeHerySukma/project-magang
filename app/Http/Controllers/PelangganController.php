<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PelangganController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        // Hitung statistik
        $totalPemesanan = Pemesanan::where('user_id', $user->id)->count();
        
        $pemesananSelesai = Pemesanan::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
        
        $totalBelanja = Pemesanan::where('user_id', $user->id)
            ->whereIn('status', ['paid', 'confirmed', 'active', 'completed'])
            ->sum('total_harga');

        // Pemesanan terbaru
        $pemesananTerbaru = Pemesanan::where('user_id', $user->id)
            ->with('mobil')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('pelanggan.dashboard', compact(
            'totalPemesanan', 
            'pemesananSelesai', 
            'totalBelanja',
            'pemesananTerbaru'
        ));
    }
}