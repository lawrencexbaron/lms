<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Room 1',
                'code' => 'R1',
                'status' => 'active',
            ],
            [
                'name' => 'Room 2',
                'code' => 'R2',
                'status' => 'active',
            ],
            [
                'name' => 'Room 3',
                'code' => 'R3',
                'status' => 'active',
            ],
            [
                'name' => 'Room 4',
                'code' => 'R4',
                'status' => 'active',
            ],
            [
                'name' => 'Room 5',
                'code' => 'R5',
                'status' => 'active',
            ],
        ];
    }
}
