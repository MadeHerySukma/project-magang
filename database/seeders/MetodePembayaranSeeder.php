<?php

namespace Database\Seeders;

use App\Models\MetodePembayaran;
use Illuminate\Database\Seeder;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metodePembayaran = [
            // ===========================
            // BANK TRANSFER
            // ===========================
            [
                'nama_metode' => 'Transfer Bank BCA',
                'kode' => 'transfer_bca',
                'tipe' => 'bank',
                'nama_penerima' => 'BCA',
                'nomor_rekening' => '1234567890',
                'atas_nama' => 'PT Rental Mobil Sejahtera',
                'instruksi' => 'Transfer ke rekening BCA dengan nomor di atas. Pastikan nominal sesuai dengan total pembayaran.',
                'is_active' => true,
                'urutan' => 1,
            ],
            [
                'nama_metode' => 'Transfer Bank BNI',
                'kode' => 'transfer_bni',
                'tipe' => 'bank',
                'nama_penerima' => 'BNI',
                'nomor_rekening' => '0987654321',
                'atas_nama' => 'PT Rental Mobil Sejahtera',
                'instruksi' => 'Transfer ke rekening BNI dengan nomor di atas. Pastikan nominal sesuai dengan total pembayaran.',
                'is_active' => true,
                'urutan' => 2,
            ],
            [
                'nama_metode' => 'Transfer Bank Mandiri',
                'kode' => 'transfer_mandiri',
                'tipe' => 'bank',
                'nama_penerima' => 'Mandiri',
                'nomor_rekening' => '1122334455',
                'atas_nama' => 'PT Rental Mobil Sejahtera',
                'instruksi' => 'Transfer ke rekening Mandiri dengan nomor di atas. Pastikan nominal sesuai dengan total pembayaran.',
                'is_active' => true,
                'urutan' => 3,
            ],

            // ===========================
            // VIRTUAL ACCOUNT
            // ===========================
            [
                'nama_metode' => 'Virtual Account BCA',
                'kode' => 'va_bca',
                'tipe' => 'bank',
                'nama_penerima' => 'BCA Virtual Account',
                'nomor_rekening' => '80777123456789',
                'atas_nama' => 'PT Rental Mobil Sejahtera',
                'instruksi' => 'Bayar melalui Virtual Account BCA. Gunakan nomor VA di atas untuk pembayaran.',
                'is_active' => true,
                'urutan' => 4,
            ],
            [
                'nama_metode' => 'Virtual Account BNI',
                'kode' => 'va_bni',
                'tipe' => 'bank',
                'nama_penerima' => 'BNI Virtual Account',
                'nomor_rekening' => '80888123456789',
                'atas_nama' => 'PT Rental Mobil Sejahtera',
                'instruksi' => 'Bayar melalui Virtual Account BNI. Gunakan nomor VA di atas untuk pembayaran.',
                'is_active' => true,
                'urutan' => 5,
            ],
            [
                'nama_metode' => 'Virtual Account Mandiri',
                'kode' => 'va_mandiri',
                'tipe' => 'bank',
                'nama_penerima' => 'Mandiri Virtual Account',
                'nomor_rekening' => '80999123456789',
                'atas_nama' => 'PT Rental Mobil Sejahtera',
                'instruksi' => 'Bayar melalui Virtual Account Mandiri. Gunakan nomor VA di atas untuk pembayaran.',
                'is_active' => true,
                'urutan' => 6,
            ],

            // ===========================
            // E-WALLET
            // ===========================
            [
                'nama_metode' => 'DANA',
                'kode' => 'dana',
                'tipe' => 'ewallet',
                'nama_penerima' => 'DANA',
                'nomor_rekening' => '081234567890',
                'atas_nama' => 'PT Rental Mobil Sejahtera',
                'instruksi' => 'Transfer ke nomor DANA di atas. Pastikan nominal sesuai dengan total pembayaran.',
                'is_active' => true,
                'urutan' => 7,
            ],
            [
                'nama_metode' => 'OVO',
                'kode' => 'ovo',
                'tipe' => 'ewallet',
                'nama_penerima' => 'OVO',
                'nomor_rekening' => '081298765432',
                'atas_nama' => 'PT Rental Mobil Sejahtera',
                'instruksi' => 'Transfer ke nomor OVO di atas. Pastikan nominal sesuai dengan total pembayaran.',
                'is_active' => true,
                'urutan' => 8,
            ],
            [
                'nama_metode' => 'GoPay',
                'kode' => 'gopay',
                'tipe' => 'ewallet',
                'nama_penerima' => 'GoPay',
                'nomor_rekening' => '081234509876',
                'atas_nama' => 'PT Rental Mobil Sejahtera',
                'instruksi' => 'Transfer ke nomor GoPay di atas. Pastikan nominal sesuai dengan total pembayaran.',
                'is_active' => true,
                'urutan' => 9,
            ],
            [
                'nama_metode' => 'LinkAja',
                'kode' => 'linkaja',
                'tipe' => 'ewallet',
                'nama_penerima' => 'LinkAja',
                'nomor_rekening' => '081267894321',
                'atas_nama' => 'PT Rental Mobil Sejahtera',
                'instruksi' => 'Transfer ke nomor LinkAja di atas. Pastikan nominal sesuai dengan total pembayaran.',
                'is_active' => true,
                'urutan' => 10,
            ],
            [
                'nama_metode' => 'ShopeePay',
                'kode' => 'shopeepay',
                'tipe' => 'ewallet',
                'nama_penerima' => 'ShopeePay',
                'nomor_rekening' => '081298761234',
                'atas_nama' => 'PT Rental Mobil Sejahtera',
                'instruksi' => 'Transfer ke nomor ShopeePay di atas. Pastikan nominal sesuai dengan total pembayaran.',
                'is_active' => true,
                'urutan' => 11,
            ],
        ];

        foreach ($metodePembayaran as $metode) {
            MetodePembayaran::create($metode);
        }

        $this->command->info('✅ Metode Pembayaran berhasil di-seed!');
        $this->command->info('📦 Total: ' . count($metodePembayaran) . ' metode pembayaran');
        $this->command->info('🏦 Bank: 6 metode (Transfer + Virtual Account)');
        $this->command->info('💳 E-Wallet: 5 metode (DANA, OVO, GoPay, LinkAja, ShopeePay)');
    }
}