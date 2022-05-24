<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson::truncate();
        Lesson::create([
            'id'=>1,
            'course_id'=>1,
            'title'=>'First Java Lesson',
            'description'=>'Do this and that',
            'predefined_code'=>'public class...',
            'expected_output'=>'Hello World 1',
            'xp'=>20,
            'next_lesson'=>2,
            'language'=>'java',
        ]);
        Lesson::create([
            'id'=>2,
            'course_id'=>1,
            'title'=>'Second Java Lesson',
            'description'=>'Do this and that again',
            'predefined_code'=>'public class Second...',
            'expected_output'=>'Hello World 2',
            'xp'=>10,
            'next_lesson'=>null,
            'language'=>'java',
        ]);
        Lesson::create([
            'id'=>3,
            'course_id'=>2,
            'title'=>'First Python Lesson',
            'description'=>'Do this and that in Python',
            'predefined_code'=>'print()',
            'expected_output'=>'Hello World',
            'xp'=>15,
            'next_lesson'=>null,
            'language'=>'python',
        ]);
    }
}
