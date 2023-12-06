<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolYear;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => '2020-2021',
                'status' => 'active',
            ],
            [
                'name' => '2021-2022',
                'status' => 'active',
            ],
            [
                'name' => '2022-2023',
                'status' => 'active',
            ],
            [
                'name' => '2023-2024',
                'status' => 'active',
            ],
            [
                'name' => '2024-2025',
                'status' => 'active',
            ],
        ];

        foreach ($data as $school_year) {
            SchoolYear::create($school_year);
        }
    }
}
