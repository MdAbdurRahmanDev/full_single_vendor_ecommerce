<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'app_name', 'value' => 'Sharif Ecommerce'],
            ['key' => 'logo', 'value' => 'logo.png'],
            ['key' => 'favicon', 'value' => 'favicon.ico'],

            // SEO Settings
            ['key' => 'meta_title', 'value' => 'Best Online Shop'],
            ['key' => 'meta_description', 'value' => 'Shop with quality and confidence.'],
            ['key' => 'meta_keywords', 'value' => 'ecommerce, shop, online'],

            // Contact Settings
            ['key' => 'contact_email', 'value' => 'support@gmail.com'],
            ['key' => 'phone', 'value' => '01700000000'],
            ['key' => 'address', 'value' => 'Dhaka, Bangladesh'],

            // Social Settings
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/profile'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/profile'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/profile'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
