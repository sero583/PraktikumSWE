<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(){
        $courses = '[{"id": 1, "title": "Java Course", "description": "A Java Course for Beginners", "thumbnail_path": "java.jpg"}, {"id": 2, "title": "Python Course", "description": "A Python Course for Beginners", "thumbnail_path": "python.jpg"}]';
        return $courses;
    }

    public function recent(){
        $courses = '[{"id": 1, "title": "Java Course", "description": "A Java Course for Beginners", "thumbnail_path": "java.jpg"}]';
        return $courses;
    }

    public function show($id){
        if($id == 1){
            $course = '{"id": 1, "title": "Java Course", "description": "A Java Course for Beginners", "thumbnail_path": "java.jpg"}';
        }
        if($id == 2){
            $course = '{"id": 2, "title": "Python Course", "description": "A Python Course for Beginners", "thumbnail_path": "java.jpg"}';
        }
        return $course;
    }
}
