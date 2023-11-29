<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modules = [
            1 => 'Modular (Printed)',
            2 => 'Modular (Digital)',
            3 => 'Online',
            4 => 'Educational Television',
            5 => 'Radio-based Instruction',
            6 => 'Blended',
            7 => 'Face to Face',
        ];

        foreach ($modules as $key => $value) {
            Module::create([
                'id' => $key,
                'name' => $value,
            ]);
        }
    }
}
