<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        /* User::factory()->create([
            'employee_id' => 1,
            'first_name' => 'Test User',
            'middle_name' => 'Test User',
            'last_name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'user_type' => 1, 
            'created_at' => now(),
            'updated_at' => now()
        ]); */
    }
}
