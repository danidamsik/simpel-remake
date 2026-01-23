<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'bendahara2',
            'email' => 'bendahara@example.com',
            'password' => bcrypt('password123'),
            'role' => 'Bendahara',
        ]);
    }
}
