<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RecentCourse;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\FinishedLesson;

class CourseController extends Controller {
    public function index() {
        return Course::orderBy("position", "asc")->get();
    }

    public function recent() {
        return RecentCourse::where("user_id", Auth::user()->id)->join("courses", "recent_courses.course_id", "courses.id")->get();
    }

    public function show($id){
        $user_id = Auth::user()->id;
        if(RecentCourse::where("course_id",  $id)->where("user_id", $user_id)->exists()===false) {
            $recent_course = new RecentCourse;
            $recent_course->course_id = $id;
            $recent_course->user_id = $user_id;
            $recent_course->save();
        }
        return Course::find($id);
    }

    public function xp($id){
        $lessons_xp = Lesson::select("xp")->where("course_id", $id)->get();
        $course_xp = 0;
        foreach($lessons_xp as $lesson){
            $course_xp += $lesson->xp;
        }

        $user = Auth::user();
        $users_xp = FinishedLesson::where("user_id", $user->id)->join("lessons", "finished_lessons.lesson_id", "lessons.id")->where("course_id", $id)->select("xp")->get();
        $user_xp = 0;
        foreach($users_xp as $user){
            $user_xp += $user->xp;
        }
        return response()->json([
            "course_xp" => $course_xp,
            "user_xp" => $user_xp
        ], 200);
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
