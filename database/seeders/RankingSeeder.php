<?php

namespace Database\Seeders;

use App\Models\Ranking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ranking::create(['id' => 1, 'title' => 'Instructor 1']);
        Ranking::create(['id' => 2, 'title' => 'Instructor 2']);
        Ranking::create(['id' => 3, 'title' => 'Instructor 3']);
        Ranking::create(['id' => 4, 'title' => 'Instructor 4']);
        Ranking::create(['id' => 5, 'title' => 'Instructor 5']);
        Ranking::create(['id' => 6, 'title' => 'Instructor 6']);
        Ranking::create(['id' => 7, 'title' => 'Instructor 7']);

        Ranking::create(['id' => 8, 'title' => 'Assistant Prof. 1']);
        Ranking::create(['id' => 9, 'title' => 'Assistant Prof. 2']);
        Ranking::create(['id' => 10, 'title' => 'Assistant Prof. 3']);
        Ranking::create(['id' => 11, 'title' => 'Assistant Prof. 4']);
        Ranking::create(['id' => 12, 'title' => 'Assistant Prof. 5']);
        Ranking::create(['id' => 13, 'title' => 'Assistant Prof. 6']);
        Ranking::create(['id' => 14, 'title' => 'Assistant Prof. 7']);

        Ranking::create(['id' => 15, 'title' => 'Associate Prof. 1']);
        Ranking::create(['id' => 16, 'title' => 'Associate Prof. 2']);
        Ranking::create(['id' => 17, 'title' => 'Associate Prof. 3']);
        Ranking::create(['id' => 18, 'title' => 'Associate Prof. 4']);
        Ranking::create(['id' => 19, 'title' => 'Associate Prof. 5']);
        Ranking::create(['id' => 20, 'title' => 'Associate Prof. 6']);
        Ranking::create(['id' => 21, 'title' => 'Associate Prof. 7']);

        Ranking::create(['id' => 22, 'title' => 'Professor 1']);
        Ranking::create(['id' => 23, 'title' => 'Professor 2']);
        Ranking::create(['id' => 24, 'title' => 'Professor 3']);
        Ranking::create(['id' => 25, 'title' => 'Professor 4']);
        Ranking::create(['id' => 26, 'title' => 'Professor 5']);
        Ranking::create(['id' => 27, 'title' => 'Professor 6']);
        Ranking::create(['id' => 28, 'title' => 'Professor 7']);
        Ranking::create(['id' => 29, 'title' => 'Professor 8']);
        Ranking::create(['id' => 30, 'title' => 'Professor 9']);
        Ranking::create(['id' => 31, 'title' => 'Professor 10']);
        Ranking::create(['id' => 32, 'title' => 'Professor 11']);
        Ranking::create(['id' => 33, 'title' => 'Professor 12']);
        Ranking::create(['id' => 34, 'title' => 'Univ. Professor']);
    }
}
