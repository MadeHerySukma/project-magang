<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class PelangganMobilController extends Controller
{
    public function index(Request $request)
    {
        $query = Mobil::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('model', 'like', '%' . $request->search . '%')
                  ->orWhere('merek', 'like', '%' . $request->search . '%');
            });
        }

        // Filter Jenis
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Filter Merek
        if ($request->filled('merek')) {
            $query->where('merek', $request->merek);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'Tersedia');
        }

        // Filter Harga Max
        if ($request->filled('harga_max')) {
            $query->where('harga_sewa', '<=', $request->harga_max);
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort == 'harga_asc') {
            $query->orderBy('harga_sewa', 'asc');
        } elseif ($sort == 'harga_desc') {
            $query->orderBy('harga_sewa', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $mobils = $query->paginate(9)->withQueryString();
        
        // Data untuk dropdown filter
        $jenis_list = ['Sedan', 'SUV', 'MPV', 'Hatchback', 'Pickup'];
        $merek_list = Mobil::distinct()->pluck('merek');

        return view('pelanggan.mobil.index', compact('mobils', 'jenis_list', 'merek_list'));
    }

    public function show($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view('pelanggan.mobil.show', compact('mobil'));
    }
    
}