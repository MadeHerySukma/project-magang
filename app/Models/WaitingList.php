<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model: WaitingList
 * 
 * Mengelola data pelanggan yang join waiting list
 * untuk mobil yang sedang tidak tersedia
 */
class WaitingList extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi mass assignment
     */
    protected $fillable = [
        'user_id',
        'mobil_id',
        'status',
        'notified_at',
        'admin_note',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'notified_at' => 'datetime',
    ];

    /**
     * Relationship ke User
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship ke Mobil
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    /**
     * Scope: Ambil yang masih waiting (belum dinotifikasi)
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWaiting($query)
    {
        return $query->where('status', 'waiting');
    }

    /**
     * Scope: Ambil yang sudah dinotifikasi
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotified($query)
    {
        return $query->where('status', 'notified');
    }

    /**
     * Scope: Filter berdasarkan mobil tertentu
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $mobilId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForMobil($query, $mobilId)
    {
        return $query->where('mobil_id', $mobilId);
    }

    /**
     * Method: Tandai sebagai sudah dinotifikasi
     * 
     * @return bool
     */
    public function markAsNotified()
    {
        return $this->update([
            'status' => 'notified',
            'notified_at' => now(),
        ]);
    }

    /**
     * Method: Batalkan waiting list
     * 
     * @return bool
     */
    public function cancel()
    {
        return $this->update([
            'status' => 'cancelled',
        ]);
    }

    /**
     * Accessor: Format status dengan badge warna
     * 
     * @return array
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'waiting' => [
                'text' => 'Menunggu',
                'color' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                'icon' => '⏳'
            ],
            'notified' => [
                'text' => 'Sudah Dihubungi',
                'color' => 'bg-green-100 text-green-800 border-green-300',
                'icon' => '✅'
            ],
            'cancelled' => [
                'text' => 'Dibatalkan',
                'color' => 'bg-red-100 text-red-800 border-red-300',
                'icon' => '❌'
            ],
        ];

        return $badges[$this->status] ?? $badges['waiting'];
    }
}