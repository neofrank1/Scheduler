<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        College::insert([
            'short_name' => 'COEduc',
            'full_name' => 'College of Education',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        College::insert([
            'short_name' => 'COEng',
            'full_name' => 'College of Engineering',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        College::insert([
            'short_name' => 'COT',
            'full_name' => 'College of Technology',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        College::insert([
            'short_name' => '',
            'full_name' => 'College of Management and Entrepreneurship',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        College::insert([
            'short_name' => 'CCICT',
            'full_name' => 'College of Science',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        College::insert([
            'short_name' => 'CAS',
            'full_name' => 'College of Arts and Science',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
