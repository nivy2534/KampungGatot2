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
        // Create an admin user if not exists
        User::updateOrCreate(
            ['email' => 'admin@kampunggatot.com'],
            [
                'name' => 'Admin Kampung Gatot',
                'email' => 'admin@kampunggatot.com',
                'password' => Hash::make('admin123'),
                'approval_status' => 'approved',
                'approved_at' => now(),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@kampunggatot.com');
        $this->command->info('Password: admin123');
    }
}
