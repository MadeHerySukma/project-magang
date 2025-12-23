<?php

namespace App\Http\Controllers;

use App\Models\WaitingList;
use App\Models\Mobil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Controller: WaitingListController (SIMPLE VERSION)
 * 
 * User klik join waiting list → input email + password → submit
 * Controller validasi dan return notifikasi sesuai kondisi
 */
class WaitingListController extends Controller
{
    /**
     * Method: Join Waiting List
     * 
     * Validasi:
     * 1. Email & password wajib diisi
     * 2. Email harus format valid
     * 3. Email harus terdaftar di sistem
     * 4. Password harus benar
     * 5. User belum join waiting list untuk mobil ini
     * 
     * Notifikasi:
     * - Success: Berhasil join waiting list
     * - Error: Email tidak terdaftar
     * - Error: Password salah
     * - Info: Sudah terdaftar di waiting list
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // ============================================
        // 1. VALIDASI INPUT DASAR
        // ============================================
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'mobil_id' => 'required|exists:mobils,id',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'mobil_id.required' => 'Mobil tidak valid',
            'mobil_id.exists' => 'Mobil tidak ditemukan',
        ]);

        // Jika validasi format gagal
        if ($validator->fails()) {
            // Get mobil info untuk auto-open modal
            $mobil = Mobil::find($request->mobil_id);
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal_open', true)
                ->with('modal_mobil_id', $request->mobil_id)
                ->with('modal_mobil_nama', $mobil ? "{$mobil->merek} {$mobil->model}" : '')
                ->with('modal_mobil_harga', $mobil ? $mobil->harga_format : '')
                ->with('modal_mobil_foto', $mobil && $mobil->foto_depan ? asset('storage/' . $mobil->foto_depan) : '')
                ->with('waiting_list_error', $validator->errors()->first());
        }

        // ============================================
        // 2. CEK APAKAH EMAIL TERDAFTAR
        // ============================================
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Get mobil info
            $mobil = Mobil::find($request->mobil_id);
            
            // NOTIFIKASI: Email tidak terdaftar
            return redirect()->back()
                ->withInput()
                ->with('modal_open', true)
                ->with('modal_mobil_id', $request->mobil_id)
                ->with('modal_mobil_nama', $mobil ? "{$mobil->merek} {$mobil->model}" : '')
                ->with('modal_mobil_harga', $mobil ? $mobil->harga_format : '')
                ->with('modal_mobil_foto', $mobil && $mobil->foto_depan ? asset('storage/' . $mobil->foto_depan) : '')
                ->with('waiting_list_error', '❌ Email tidak terdaftar di sistem. Silakan daftar terlebih dahulu agar bisa join waiting list.');
        }

        // ============================================
        // 3. CEK PASSWORD BENAR ATAU SALAH
        // ============================================
        if (!Hash::check($request->password, $user->password)) {
            // Get mobil info
            $mobil = Mobil::find($request->mobil_id);
            
            // NOTIFIKASI: Password salah
            return redirect()->back()
                ->withInput(['email' => $request->email]) // Keep email
                ->with('modal_open', true)
                ->with('modal_mobil_id', $request->mobil_id)
                ->with('modal_mobil_nama', $mobil ? "{$mobil->merek} {$mobil->model}" : '')
                ->with('modal_mobil_harga', $mobil ? $mobil->harga_format : '')
                ->with('modal_mobil_foto', $mobil && $mobil->foto_depan ? asset('storage/' . $mobil->foto_depan) : '')
                ->with('waiting_list_error', '❌ Password salah. Silakan coba lagi.');
        }

        // ============================================
        // 4. CEK APAKAH USER PUNYA NO HP
        // ============================================
        if (!$user->no_hp) {
            // Get mobil info
            $mobil = Mobil::find($request->mobil_id);
            
            // NOTIFIKASI: No HP belum ada
            return redirect()->back()
                ->withInput()
                ->with('modal_open', true)
                ->with('modal_mobil_id', $request->mobil_id)
                ->with('modal_mobil_nama', $mobil ? "{$mobil->merek} {$mobil->model}" : '')
                ->with('modal_mobil_harga', $mobil ? $mobil->harga_format : '')
                ->with('modal_mobil_foto', $mobil && $mobil->foto_depan ? asset('storage/' . $mobil->foto_depan) : '')
                ->with('waiting_list_error', '⚠️ Akun Anda belum memiliki nomor HP/WhatsApp. Silakan update profil Anda terlebih dahulu atau hubungi admin.');
        }

        // ============================================
        // 5. CEK APAKAH SUDAH JOIN WAITING LIST
        // ============================================
        $existingWaitingList = WaitingList::where('user_id', $user->id)
            ->where('mobil_id', $request->mobil_id)
            ->whereIn('status', ['waiting', 'notified'])
            ->first();

        if ($existingWaitingList) {
            // NOTIFIKASI: Sudah terdaftar di waiting list
            $mobil = Mobil::find($request->mobil_id);
            
            return redirect()->back()
                ->with('modal_open', true)
                ->with('modal_mobil_id', $request->mobil_id)
                ->with('modal_mobil_nama', $mobil ? "{$mobil->merek} {$mobil->model}" : '')
                ->with('modal_mobil_harga', $mobil ? $mobil->harga_format : '')
                ->with('modal_mobil_foto', $mobil && $mobil->foto_depan ? asset('storage/' . $mobil->foto_depan) : '')
                ->with('waiting_list_info', 
                    "ℹ️ Anda sudah terdaftar dalam waiting list untuk {$mobil->merek} {$mobil->model}. " .
                    "Admin akan menghubungi Anda via WhatsApp ({$user->no_hp}) jika mobil sudah tersedia."
                );
        }

        // ============================================
        // 6. SIMPAN KE DATABASE WAITING_LISTS
        // ============================================
        $mobil = Mobil::findOrFail($request->mobil_id);

        WaitingList::create([
            'user_id' => $user->id,
            'mobil_id' => $request->mobil_id,
            'status' => 'waiting',
        ]);

        // ============================================
        // 7. NOTIFIKASI SUCCESS
        // ============================================
        return redirect()->back()
            ->with('modal_open', true)
            ->with('modal_mobil_id', $request->mobil_id)
            ->with('modal_mobil_nama', "{$mobil->merek} {$mobil->model}")
            ->with('modal_mobil_harga', $mobil->harga_format)
            ->with('modal_mobil_foto', $mobil->foto_depan ? asset('storage/' . $mobil->foto_depan) : '')
            ->with('waiting_list_success', 
                "✅ Berhasil! Anda telah terdaftar dalam waiting list untuk {$mobil->merek} {$mobil->model}. " .
                "Admin akan menghubungi Anda via WhatsApp ({$user->no_hp}) jika mobil sudah tersedia."
            );
    }

    /**
     * Method: Cancel Waiting List
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel($id)
    {
        $waitingList = WaitingList::findOrFail($id);

        // Pastikan user hanya bisa cancel waiting list nya sendiri
        if ($waitingList->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $waitingList->cancel();

        return redirect()->back()->with('success', 'Waiting list berhasil dibatalkan.');
    }
}