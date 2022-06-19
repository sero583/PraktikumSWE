<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::truncate();
        Course::create([
            'position' => 1,
            'title'=>'Java Course',
            'description'=>'A Java Course for Beginners',
            'thumbnail_path'=>'java.jpg'
        ]);
        Course::create([
            'position' => 2,
            'title'=>'Python Course',
            'description'=>'A Python Course for Beginners',
            'thumbnail_path'=>'python.jpg'
        ]);
        Course::create([
            'position' => 3,
            'title'=>'Javascript Course',
            'description'=>'This is a Javascript course for beginners. Javascript is the most important programming language for the internet as virtually every website uses it.',
            'thumbnail_path'=>'javascript.jpg'
        ]);
    }
}
