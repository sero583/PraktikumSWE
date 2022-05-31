<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RecentCourse;
use App\Models\Course;

class CourseController extends Controller {
    public function index() {
        return Course::orderBy("position", "asc")->get();
    }

    public function recent() {
        return RecentCourse::where("user_id", Auth::user()->id)->join("courses", "recent_courses.course_id", "courses.id")->get();
    }

    public function show($id){
        return Course::find($id);
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
