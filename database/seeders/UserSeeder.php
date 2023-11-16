<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Baron',
                'middle_name' => 'Admin',
                'email' => 'admin@admin.com',
                'role' => 'admin',
                'password' => bcrypt('password'),
            ],
            [
                'first_name' => 'Teacher',
                'last_name' => 'Teacher',
                'middle_name' => 'Teacher',
                'email' => 'teacher@teacher.com',
                'role' => 'teacher',
                'password' => bcrypt('password'),
            ],
            [
                'first_name' => 'Teacher1',
                'last_name' => 'Teacher1',
                'middle_name' => 'Teacher',
                'email' => 'teacher@teacher1.com',
                'role' => 'teacher',
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
