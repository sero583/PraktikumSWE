<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FinishedLesson;

class FinishedLessonSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FinishedLesson::truncate();
        FinishedLesson::create([
            'user_id'=>1,
            'lesson_id'=>3
        ]);
    }
}
