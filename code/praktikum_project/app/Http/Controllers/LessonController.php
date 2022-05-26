<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function index($course_id){
        $lessons = DB::table('lessons')->where('course_id', $course_id)->get();
        //TODO order lessons by next_lesson
        return $lessons;
    }

    public function show($course_id, $lesson_id){
        $lesson = DB::table('lessons')->find($lesson_id);
        return $lesson;
    }

    public function store(Request $request){
        //untested
        $lesson = new Lesson;
        $lesson->course_id = $request->course_id;
        $lesson->title = $request->title;
        $lesson->description = $request->description;
        $lesson->predefined_code = $request->predefined_code;
        $lesson->expected_output = $request->expected_output;
        $lesson->xp = $request->xp;
        $lesson->next_lesson = $request->next_lesson;
        $lesson->language = $request->language;
        $lesson->save();
    }

    public function update(Request $request, $id){
        //untested
        $lesson = Lesson::find($id);
        $lesson->course_id = $request->course_id;
        $lesson->title = $request->title;
        $lesson->description = $request->description;
        $lesson->predefined_code = $request->predefined_code;
        $lesson->expected_output = $request->expected_output;
        $lesson->xp = $request->xp;
        $lesson->next_lesson = $request->next_lesson;
        $lesson->language = $request->language;
        $lesson->save();
    }

    public function delete($id){
        //untested
        $lesson = Lesson::find($id);
        $lesson->delete();
        Lesson::truncate();
    }
}
