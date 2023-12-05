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
            'system_email' => 'admin@admin@.com',
            'system_title' => 'Enhanced Enrollment System',
        ]);
        
    }
}
