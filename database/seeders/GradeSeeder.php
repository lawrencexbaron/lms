<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => 'Grade 6',
            ],
            [
                'name' => 'Grade 7',
            ],
            [
                'name' => 'Grade 8',
            ],
            [
                'name' => 'Grade 9',
            ],
            [
                'name' => 'Grade 10',
            ],
            [
                'name' => 'Grade 11',
            ],
            [
                'name' => 'Grade 12',
            ],
        ];

        foreach ($data as $grade) {
            Grade::create($grade);
        }
        
    }
}
