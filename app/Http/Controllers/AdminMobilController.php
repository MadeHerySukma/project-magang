<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMobilController extends Controller
{
    // METHOD INDEX YANG DIUPDATE DENGAN SEARCH & FILTER
    public function index(Request $request)
    {
        $query = Mobil::query();

        // Search - mencari di merek, model, dan nomor plat
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('model', 'like', '%' . $request->search . '%')
                  ->orWhere('merek', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_plat', 'like', '%' . $request->search . '%');
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
        }

        // Filter Harga Max
        if ($request->filled('harga_max')) {
            $query->where('harga_sewa', '<=', $request->harga_max);
        }

        // Filter Tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        if ($sort == 'harga_asc') {
            $query->orderBy('harga_sewa', 'asc');
        } elseif ($sort == 'harga_desc') {
            $query->orderBy('harga_sewa', 'desc');
        } elseif ($sort == 'tahun_desc') {
            $query->orderBy('tahun', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Pagination dengan Query String agar filter tetap ada saat pindah halaman
        $mobils = $query->paginate(6)->withQueryString();
        
        // Data untuk dropdown filter
        $jenis_list = ['Sedan', 'SUV', 'MPV', 'Hatchback', 'Pickup'];
        $merek_list = Mobil::distinct()->pluck('merek');
        $tahun_list = Mobil::distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        
        return view('admin.mobil.index', compact('mobils', 'jenis_list', 'merek_list', 'tahun_list'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'merek' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'jenis' => 'required|in:Sedan,SUV,MPV,Hatchback,Pickup',
            'nomor_plat' => 'required|string|unique:mobils,nomor_plat',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'harga_sewa' => 'required|numeric|min:0',
            'status' => 'required|in:Tersedia,Disewa,Dalam Perawatan',
            'deskripsi' => 'nullable|string',
            'foto_depan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_belakang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_interior' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_samping_kiri' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_samping_kanan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Upload foto depan
        if ($request->hasFile('foto_depan')) {
            $data['foto_depan'] = $request->file('foto_depan')->store('mobil', 'public');
        }

        // Upload foto belakang
        if ($request->hasFile('foto_belakang')) {
            $data['foto_belakang'] = $request->file('foto_belakang')->store('mobil', 'public');
        }

        // Upload foto interior
        if ($request->hasFile('foto_interior')) {
            $data['foto_interior'] = $request->file('foto_interior')->store('mobil', 'public');
        }

        // Upload foto samping kiri
        if ($request->hasFile('foto_samping_kiri')) {
            $data['foto_samping_kiri'] = $request->file('foto_samping_kiri')->store('mobil', 'public');
        }

        // Upload foto samping kanan
        if ($request->hasFile('foto_samping_kanan')) {
            $data['foto_samping_kanan'] = $request->file('foto_samping_kanan')->store('mobil', 'public');
        }

        Mobil::create($data);

        return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);

        $request->validate([
            'merek' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'jenis' => 'required|in:Sedan,SUV,MPV,Hatchback,Pickup',
            'nomor_plat' => 'required|string|unique:mobils,nomor_plat,' . $id,
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'harga_sewa' => 'required|numeric|min:0',
            'status' => 'required|in:Tersedia,Disewa,Dalam Perawatan',
            'deskripsi' => 'nullable|string',
            'foto_depan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_belakang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_interior' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_samping_kiri' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_samping_kanan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Update foto depan
        if ($request->hasFile('foto_depan')) {
            if ($mobil->foto_depan) {
                Storage::disk('public')->delete($mobil->foto_depan);
            }
            $data['foto_depan'] = $request->file('foto_depan')->store('mobil', 'public');
        }

        // Update foto belakang
        if ($request->hasFile('foto_belakang')) {
            if ($mobil->foto_belakang) {
                Storage::disk('public')->delete($mobil->foto_belakang);
            }
            $data['foto_belakang'] = $request->file('foto_belakang')->store('mobil', 'public');
        }

        // Update foto interior
        if ($request->hasFile('foto_interior')) {
            if ($mobil->foto_interior) {
                Storage::disk('public')->delete($mobil->foto_interior);
            }
            $data['foto_interior'] = $request->file('foto_interior')->store('mobil', 'public');
        }

        // Update foto samping kiri
        if ($request->hasFile('foto_samping_kiri')) {
            if ($mobil->foto_samping_kiri) {
                Storage::disk('public')->delete($mobil->foto_samping_kiri);
            }
            $data['foto_samping_kiri'] = $request->file('foto_samping_kiri')->store('mobil', 'public');
        }

        // Update foto samping kanan
        if ($request->hasFile('foto_samping_kanan')) {
            if ($mobil->foto_samping_kanan) {
                Storage::disk('public')->delete($mobil->foto_samping_kanan);
            }
            $data['foto_samping_kanan'] = $request->file('foto_samping_kanan')->store('mobil', 'public');
        }

        $mobil->update($data);

        return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil diupdate!');
    }

    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);

        // Hapus semua foto
        if ($mobil->foto_depan) {
            Storage::disk('public')->delete($mobil->foto_depan);
        }
        if ($mobil->foto_belakang) {
            Storage::disk('public')->delete($mobil->foto_belakang);
        }
        if ($mobil->foto_interior) {
            Storage::disk('public')->delete($mobil->foto_interior);
        }
        if ($mobil->foto_samping_kiri) {
            Storage::disk('public')->delete($mobil->foto_samping_kiri);
        }
        if ($mobil->foto_samping_kanan) {
            Storage::disk('public')->delete($mobil->foto_samping_kanan);
        }

        $mobil->delete();

        return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil dihapus!');
    }
}