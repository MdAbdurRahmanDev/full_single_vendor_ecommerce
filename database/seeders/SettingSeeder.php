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
            ['key' => 'contact_hours', 'value' => 'Mon - Sat: 9 AM - 8 PM'],

            // Help Page Content
            ['key' => 'help_title', 'value' => 'Customer Support Center'],
            ['key' => 'help_sub_title', 'value' => 'We’re here to help you solve your problem as quickly as possible.'],
            ['key' => 'faq_1_title', 'value' => 'How can I track my order?'],
            ['key' => 'faq_1_content', 'value' => 'You can track your order status by clicking on the Order History tab in your account dashboard.'],
            ['key' => 'faq_2_title', 'value' => 'Do you deliver on Fridays?'],
            ['key' => 'faq_2_content', 'value' => 'Currently, our logistics partners do not provide full delivery service on Fridays, but you can choose special delivery if needed.'],

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
