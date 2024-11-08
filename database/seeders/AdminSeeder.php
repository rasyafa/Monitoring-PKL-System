<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // Password: admin123
            'role' => 'admin',
            'gender' => 'male',
            'city' => 'JakartaSelatan'
            // tambahkan field lain sesuai kebutuhan
        ]);
    }
}
