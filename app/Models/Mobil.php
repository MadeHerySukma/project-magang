<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_plat',
        'merek',
        'model',
        'jenis',
        'tahun',
        'harga_sewa',
        'status',
        'deskripsi',
        'foto_depan',
        'foto_belakang',
        'foto_interior',
        'foto_samping_kiri',
        'foto_samping_kanan',
    ];

    /**
     * PENTING: Accessor untuk harga
     * Karena di database nama kolomnya 'harga_sewa', 
     * kita buat accessor agar bisa akses dengan $mobil->harga
     */
    public function getHargaAttribute()
    {
        return $this->harga_sewa;
    }

    /**
     * Accessor untuk harga_format
     */
    public function getHargaFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga_sewa, 0, ',', '.');
    }

    /**
     * Relationship ke pemesanan
     */
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    /**
     * Cek apakah mobil tersedia di tanggal tertentu
     */
    public function isAvailable($tanggalMulai, $tanggalSelesai)
    {
        return !$this->pemesanans()
            ->whereIn('status', ['pending', 'paid', 'confirmed', 'active'])
            ->where(function($query) use ($tanggalMulai, $tanggalSelesai) {
                $query->whereBetween('tanggal_mulai', [$tanggalMulai, $tanggalSelesai])
                    ->orWhereBetween('tanggal_selesai', [$tanggalMulai, $tanggalSelesai])
                    ->orWhere(function($q) use ($tanggalMulai, $tanggalSelesai) {
                        $q->where('tanggal_mulai', '<=', $tanggalMulai)
                          ->where('tanggal_selesai', '>=', $tanggalSelesai);
                    });
            })
            ->exists();
    }

    public function waitingLists()
    {
        return $this->hasMany(\App\Models\WaitingList::class);
    }

    public function getTotalWaitingAttribute()
    {
        return $this->waitingLists()->where('status', 'waiting')->count();
    }

    public function scopeWithWaitingCount($query)
    {
        return $query->withCount([
            'waitingLists as waiting_count' => function ($q) {
                $q->where('status', 'waiting');
            }
        ]);
    }
}