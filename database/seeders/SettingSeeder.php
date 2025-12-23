<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'company_name',
                'value' => 'PT Rental Mobil Bali'
            ],
            [
                'key' => 'company_tagline',
                'value' => 'Sewa Mobil Terpercaya & Terjangkau'
            ],
            [
                'key' => 'company_description',
                'value' => 'Kami menyediakan layanan sewa mobil terbaik di Bali dengan harga terjangkau, armada lengkap, dan layanan 24/7. Nikmati perjalanan Anda dengan nyaman bersama kami.'
            ],
            [
                'key' => 'company_phone',
                'value' => '+62 812-3456-7890'
            ],
            [
                'key' => 'company_email',
                'value' => 'info@ptrentalmobil.com'
            ],
            [
                'key' => 'company_address',
                'value' => 'Jl. Sunset Road No. 123, Denpasar, Bali 80361'
            ],
            // 5 Hero Images for Slider
            [
                'key' => 'hero_image_1',
                'value' => null // Admin akan upload nanti
            ],
            [
                'key' => 'hero_image_2',
                'value' => null
            ],
            [
                'key' => 'hero_image_3',
                'value' => null
            ],
            [
                'key' => 'hero_image_4',
                'value' => null
            ],
            [
                'key' => 'hero_image_5',
                'value' => null
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}