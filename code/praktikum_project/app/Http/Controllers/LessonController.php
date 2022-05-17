<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show($course_id, $lesson_id){
        if($lesson_id == 1){
            $lesson = '{"id": 1, "course_id": 1, "title": "Name of the first Java Lesson", "description": "Instructions what has to be implemented", "predefined_code": "public class First...", "expected_output":"Hello World", "xp": 20, "next_lesson": 2}';
        }
        if($lesson_id == 2){
            $lesson = '{"id": 2, "course_id": 1, "title": "Name of the second Java Lesson", "description": "Instructions what has to be implemented", "predefined_code": "public class Second...", "expected_output":"Hello World", "xp": 20, "next_lesson": null}';
        }
        if($lesson_id == 3){
            $lesson = '{"id": 3, "course_id": 2, "title": "Name of the first Python Lesson", "description": "Instructions what has to be implemented", "predefined_code": "print(\"python\")", "expected_output":"python", "xp": 10, "next_lesson": null}';
        }
        return $lesson;
    }
}
