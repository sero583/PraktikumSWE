<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(){
        $courses = DB::table('courses')->orderBy('title', 'asc')->get();
        return $courses;
    }

    public function recent(){
        $user_id = 1; //TODO replace with actual id
        $courses = DB::table('recent_courses')->where('id', $user_id)->join('courses', 'recent_courses.course_id', 'courses.id')->get();
        return $courses;
    }

    public function show($id){
        $course = DB::table('courses')->find($id);
        return $course;
    }

    public function lessons($id){
        $lessons = DB::table('lessons')->where('course_id', $id)->get();
        //TODO order lessons by next_lesson
        return $lessons;
    }

    public function store(Request $request){
        //untested
        $course = new Course;
        $course->title = $request->title;
        $course->description = $request->description;
        $course->thumbnail_path = $request->thumbnail_path;
        $course->save();
    }

    public function update(Request $request, $id){
        //untested
        $course = Course::find($id);
        $course->title = $request->title;
        $course->description = $request->description;
        $course->thumbnail_path = $request->thumbnail_path;
        $course->save();
    }

    public function delete($id){
        //untested
        $course = Course::find($id);
        $course->delete();
        Course::truncate();
    }
}
