<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Daftar semua user
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Search berdasarkan nama atau email
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Urutkan
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $users = $query->get();

        // Statistik
        $totalUsers = User::count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        $totalAdmin = User::where('role', 'admin')->count();

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'totalPelanggan',
            'totalAdmin'
        ));
    }

    /**
     * Detail user dan riwayat transaksi
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        // Ambil riwayat pemesanan
        $pemesanans = Pemesanan::where('user_id', $id)
            ->with('mobil')
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistik user
        $totalPemesanan = $pemesanans->count();
        $pemesananSelesai = $pemesanans->where('status', 'completed')->count();
        $pemesananAktif = $pemesanans->where('status', 'active')->count();
        $pemesananPending = $pemesanans->whereIn('status', ['pending', 'paid', 'confirmed'])->count();
        
        $totalBelanja = $pemesanans->whereIn('status', ['paid', 'confirmed', 'active', 'completed'])
            ->sum('total_harga');

        return view('admin.users.show', compact(
            'user',
            'pemesanans',
            'totalPemesanan',
            'pemesananSelesai',
            'pemesananAktif',
            'pemesananPending',
            'totalBelanja'
        ));
    }

    /**
     * Form edit user
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'no_hp' => 'required|string|max:15',
            'role' => 'required|in:admin,pelanggan',
            'password' => 'nullable|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.max' => 'Nomor HP maksimal 15 karakter.',
            'role.required' => 'Role wajib dipilih.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'role' => $request->role,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.show', $id)
            ->with('success', 'Data user berhasil diupdate!');
    }

    /**
     * Hapus user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cek apakah user yang login mencoba menghapus dirinya sendiri
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        // Cek apakah user punya pemesanan aktif
        $pemesananAktif = Pemesanan::where('user_id', $id)
            ->whereIn('status', ['pending', 'paid', 'confirmed', 'active'])
            ->count();

        if ($pemesananAktif > 0) {
            return back()->with('error', 'User memiliki pemesanan aktif. Tidak dapat dihapus!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus!');
    }

    /**
     * Toggle status user (aktif/nonaktif)
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Cek apakah user yang login mencoba menonaktifkan dirinya sendiri
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun Anda sendiri!');
        }

        // Toggle status (misal pakai kolom is_active jika ada)
        // Atau bisa pakai soft delete
        // Untuk sekarang kita kasih placeholder
        
        return back()->with('success', 'Status user berhasil diubah!');
    }
}