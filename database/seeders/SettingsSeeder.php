<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Setting::create([
            'system_name' => 'Enrollment System',
            'system_email' => 'admin@admin.com',
            'system_title' => 'Enhanced Enrollment System',
            'logo' => 'uploads/logo.png',
            'favicon' => 'uploads/favicon.png',
            'background_logo' => 'uploads/background.png',
            'school_year_id' => 3,
            'address' => 'Navotas City',
            'phone' => '09123456789',
        ]);
        
    }
}
