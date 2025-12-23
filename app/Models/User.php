<?php

namespace App\Models;

// PENTING: Import yang diperlukan
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // tambahkan role jika belum ada
        'no_hp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * TAMBAHAN: Relationship ke pemesanan
     */
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    /**
     * Untuk mendapatkan total pemesanan user
     */
    public function getTotalPemesananAttribute()
    {
        return $this->pemesanans()->count();
    }

    /**
     * Untuk mendapatkan pemesanan selesai
     */
    public function getPemesananSelesaiAttribute()
    {
        return $this->pemesanans()->where('status', 'completed')->count();
    }

    /**
     * Untuk mendapatkan total belanja
     */
    public function getTotalBelanjaAttribute()
    {
        return $this->pemesanans()
            ->whereIn('status', ['paid', 'confirmed', 'active', 'completed'])
            ->sum('total_harga');
    }

    // ============================================
    // NEW: WAITING LIST RELATIONSHIPS
    // ============================================
    
    /**
     * Relationship: User has many waiting lists
     */
    public function waitingLists()
    {
        return $this->hasMany(\App\Models\WaitingList::class);
    }

    /**
     * Accessor: Get total waiting lists for this user
     */
    public function getTotalWaitingListsAttribute()
    {
        return $this->waitingLists()->where('status', 'waiting')->count();
    }
}