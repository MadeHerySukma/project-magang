<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_metode',
        'kode',
        'tipe',
        'nama_penerima',
        'nomor_rekening',
        'atas_nama',
        'logo',
        'instruksi',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi ke Pemesanan
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'metode_pembayaran', 'kode');
    }

    // Scope untuk metode aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk bank
    public function scopeBank($query)
    {
        return $query->where('tipe', 'bank');
    }

    // Scope untuk e-wallet
    public function scopeEwallet($query)
    {
        return $query->where('tipe', 'ewallet');
    }

    // Helper untuk format nomor rekening
    public function getNomorRekeningFormatAttribute()
    {
        // Format: 1234-5678-9012 atau 0812-3456-7890
        $nomor = $this->nomor_rekening;
        
        if ($this->tipe === 'bank' && strlen($nomor) >= 10) {
            // Format bank: 1234-5678-9012
            return chunk_split($nomor, 4, '-');
        } elseif ($this->tipe === 'ewallet') {
            // Format e-wallet: 0812-3456-7890
            return preg_replace('/(\d{4})(\d{4})(\d+)/', '$1-$2-$3', $nomor);
        }
        
        return $nomor;
    }

    // Helper untuk icon
    public function getIconAttribute()
    {
        $icons = [
            'bank' => '🏦',
            'ewallet' => '💳',
        ];

        return $icons[$this->tipe] ?? '💰';
    }
}