<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing users to ensure a clean state (optional, be careful in production)
        // User::truncate();

        // Create 3 admin users
        User::firstOrCreate(
            ['email' => 'admin1@kpu.go.id'],
            [
                'name' => 'Admin KPU 1',
                'password' => Hash::make('password'),
                'is_verified' => true,
                'is_admin' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin2@kpu.go.id'],
            [
                'name' => 'Admin KPU 2',
                'password' => Hash::make('password'),
                'is_verified' => true,
                'is_admin' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin3@kpu.go.id'],
            [
                'name' => 'Admin KPU 3',
                'password' => Hash::make('password'),
                'is_verified' => true,
                'is_admin' => true,
            ]
        );
    }
}
