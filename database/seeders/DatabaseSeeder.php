<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Kevin',
            'username' => 'kevin_hacker',
            'email' => 'kevin@kevin.com',
            'is_admin' => true,
            'password' => Hash::make('kevin123'),
        ]);

        User::factory(10)->create();
    }
}
