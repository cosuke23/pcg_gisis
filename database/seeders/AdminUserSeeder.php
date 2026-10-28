<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@pcg-gisis.com',
            'password' => Hash::make('Admin@12345'),
        ]);
    }
}