<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'id_number' => '1234567890',
            'phone' => '500000000',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234'),
            'is_approved' => true,
        ]);
    }
}
