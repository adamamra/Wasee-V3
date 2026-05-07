<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'id_number' => '1234567890',
                'phone' => '500000000',
                'email' => 'admin@example.com',
                'password' => Hash::make('1234'),
                'is_admin' => true,
                'is_approved' => true,
            ]);
            
            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@example.com');
            $this->command->info('Password: 1234');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
