<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Setting;
use Illuminate\Http\Request;
// Import Facade Auth
use Illuminate\Support\Facades\Auth; 

class AdminHomeController extends Controller
{
    /**
     * Display landing page
     * * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Ambil data user yang sedang login
        $user = Auth::user(); 
        
        // Get settings untuk hero section
        $settings = Setting::getAll();
        
        // Get mobil TERSEDIA (status = Tersedia) - LIMIT 10
        $mobilTersedia = Mobil::where('status', 'Tersedia')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        // Get mobil BELUM TERSEDIA (status = Disewa atau Dalam Perawatan) - LIMIT 10
        $mobilBelumTersedia = Mobil::whereIn('status', ['Disewa', 'Dalam Perawatan'])
            ->orderBy('created_at', 'desc')
            ->take(25)
            ->get();
        
        // Get total mobil per kategori
        $totalMobilTersedia = Mobil::where('status', 'Tersedia')->count();
        $totalMobilBelumTersedia = Mobil::whereIn('status', ['Disewa', 'Dalam Perawatan'])->count();
        
        // 2. Teruskan variabel $user ke view
        return view('home', compact(
            'settings', 
            'mobilTersedia', 
            'mobilBelumTersedia',
            'totalMobilTersedia', 
            'totalMobilBelumTersedia',
            'user' // <-- Tambahkan ini
        ));
    }
}