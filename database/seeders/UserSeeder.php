<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Check if the user already exists to prevent duplicate insertion issues in SQL Server
        if (!User::where('email', 'admin@hrm.com')->exists()) {
            User::create([
                'name' => 'System Administrator',
                'email' => 'admin@hrm.com',
                'password' => Hash::make('@#$%^&'), // Change this in production!

            ]);
        }
    }
}
