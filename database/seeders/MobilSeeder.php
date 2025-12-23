<?php

namespace Database\Seeders;

use App\Models\Mobil;
use Illuminate\Database\Seeder;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        $mobils = [
            [
                'merek' => 'Toyota',
                'model' => 'Avanza',
                'jenis' => 'MPV',
                'nomor_plat' => 'B 1234 ABC',
                'tahun' => 2023,
                'harga_sewa' => 250000,
                'status' => 'Tersedia',
                'deskripsi' => 'Mobil keluarga yang nyaman dengan kapasitas 7 penumpang. Cocok untuk perjalanan jauh bersama keluarga.',
            ],
            [
                'merek' => 'Honda',
                'model' => 'Jazz',
                'jenis' => 'Hatchback',
                'nomor_plat' => 'B 5678 DEF',
                'tahun' => 2022,
                'harga_sewa' => 300000,
                'status' => 'Tersedia',
                'deskripsi' => 'Mobil sporty dan irit BBM. Sempurna untuk perjalanan dalam kota dengan desain modern.',
            ],
            [
                'merek' => 'Suzuki',
                'model' => 'Ertiga',
                'jenis' => 'MPV',
                'nomor_plat' => 'B 9012 GHI',
                'tahun' => 2021,
                'harga_sewa' => 275000,
                'status' => 'Disewa',
                'deskripsi' => 'MPV ekonomis dengan kabin luas. Ideal untuk keluarga kecil atau rombongan.',
            ],
            [
                'merek' => 'Toyota',
                'model' => 'Fortuner',
                'jenis' => 'SUV',
                'nomor_plat' => 'B 3456 JKL',
                'tahun' => 2023,
                'harga_sewa' => 500000,
                'status' => 'Tersedia',
                'deskripsi' => 'SUV mewah dan tangguh untuk segala medan. Dilengkapi fitur 4WD dan interior premium.',
            ],
            [
                'merek' => 'Honda',
                'model' => 'Civic',
                'jenis' => 'Sedan',
                'nomor_plat' => 'B 7890 MNO',
                'tahun' => 2022,
                'harga_sewa' => 350000,
                'status' => 'Tersedia',
                'deskripsi' => 'Sedan elegan dengan performa mesin yang powerful. Cocok untuk acara formal atau bisnis.',
            ],
            [
                'merek' => 'Mitsubishi',
                'model' => 'Pajero Sport',
                'jenis' => 'SUV',
                'nomor_plat' => 'B 2345 PQR',
                'tahun' => 2023,
                'harga_sewa' => 550000,
                'status' => 'Dalam Perawatan',
                'deskripsi' => 'SUV premium dengan teknologi terkini. Kenyamanan maksimal untuk perjalanan jarak jauh.',
            ],
            [
                'merek' => 'Daihatsu',
                'model' => 'Xenia',
                'jenis' => 'MPV',
                'nomor_plat' => 'B 6789 STU',
                'tahun' => 2021,
                'harga_sewa' => 240000,
                'status' => 'Tersedia',
                'deskripsi' => 'MPV ekonomis dan efisien. Pilihan tepat untuk budget terbatas dengan kualitas terjamin.',
            ],
            [
                'merek' => 'Toyota',
                'model' => 'Innova Reborn',
                'jenis' => 'MPV',
                'nomor_plat' => 'B 1122 VWX',
                'tahun' => 2022,
                'harga_sewa' => 400000,
                'status' => 'Tersedia',
                'deskripsi' => 'MPV premium dengan kenyamanan seperti sedan. Ideal untuk perjalanan bisnis atau wisata keluarga.',
            ],
            [
                'merek' => 'Honda',
                'model' => 'Brio',
                'jenis' => 'Hatchback',
                'nomor_plat' => 'B 3344 YZA',
                'tahun' => 2020,
                'harga_sewa' => 220000,
                'status' => 'Tersedia',
                'deskripsi' => 'Mobil compact yang lincah di jalanan kota. Hemat BBM dan mudah diparkir.',
            ],
            [
                'merek' => 'Suzuki',
                'model' => 'Carry',
                'jenis' => 'Pickup',
                'nomor_plat' => 'B 5566 BCD',
                'tahun' => 2021,
                'harga_sewa' => 200000,
                'status' => 'Tersedia',
                'deskripsi' => 'Pickup andal untuk angkut barang. Kapasitas muatan besar dengan mesin tangguh.',
            ],
        ];

        foreach ($mobils as $mobil) {
            Mobil::create($mobil);
        }
    }
}