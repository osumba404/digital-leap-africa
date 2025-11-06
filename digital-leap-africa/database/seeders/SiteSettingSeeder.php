<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        // Use updateOrCreate to avoid errors on reseeding
        SiteSetting::updateOrCreate(['key' => 'site_name'], ['value' => 'Digital Leap Africa']);
        SiteSetting::updateOrCreate(['key' => 'contact_email'], ['value' => 'info@digitaleapafrica.com']);
        SiteSetting::updateOrCreate(['key' => 'phone_number'], ['value' => '+254 700 000 000']);
        SiteSetting::updateOrCreate(['key' => 'address'], ['value' => 'Nairobi, Kenya']);
        SiteSetting::updateOrCreate(['key' => 'logo_url'], ['value' => '']); // Let admin upload the first one
        SiteSetting::updateOrCreate(['key' => 'footer_text'], ['value' => '© ' . date('Y') . ' Digital Leap Africa. All Rights Reserved.']);
        SiteSetting::updateOrCreate(['key' => 'privacy_policy_url'], ['value' => '#']);
        SiteSetting::updateOrCreate(['key' => 'terms_of_service_url'], ['value' => '#']);
    }
}