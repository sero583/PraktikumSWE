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
            'course_id'=>1,
            'position'=>1,
            'title'=>'First Java Lesson',
            'description'=>'Do this and that',
            'predefined_code'=>'public class Main{public static void main(String[] args){System.out.print(\"<usercode>\");}}',
            'expected_output'=>'Hello World 1',
            'xp'=>20,
            'language'=>'java'
        ]);
        Lesson::create([
            'course_id'=>1,
            'position'=>2,
            'title'=>'Second Java Lesson',
            'description'=>'Do this and that again',
            'predefined_code'=>'public class Second...',
            'expected_output'=>'Hello World 2',
            'xp'=>10,
            'language'=>'java'
        ]);
        Lesson::create([
            'course_id'=>2,
            'position'=>1,
            'title'=>'First Python Lesson',
            'description'=>'Do this and that in Python',
            'predefined_code'=>'print(\"<usercode>\", end=\"\")',
            'expected_output'=>'Hello World',
            'xp'=>15,
            'language'=>'python'
        ]);
        Lesson::create([
            'course_id'=>3,
            "position"=>1,
            'title'=>'First Javascript Lesson',
            'description'=>'Do this and that in Javascript',
            'predefined_code'=>'process.stdout.write(\"<usercode>\")',
            'expected_output'=>'Hello World',
            'xp'=>15,
            'language'=>'javascript'
        ]);
    }
}
?>