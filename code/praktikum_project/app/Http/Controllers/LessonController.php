<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;

class LessonController extends Controller {
    public function index($course_id) {
        return Lesson::where("course_id", $course_id)->orderBy("position")->get();
    }

    public function show($course_id, $lesson_position) {
        $lesson = Lesson::where([["course_id", "=", $course_id], ["position", "=", $lesson_position]]);
        if($lesson->exists()) {
            return $lesson->first();
        }
        return response()->json([
            "success" => false,
            "message" => "Lesson does not exists."
        ], 404);
    }

    public function store(Request $request) {
        if(Course::where("id", "=", $request->course_id)->exists()===false) {
            return response()->json([
                "success" => false,
                "message" => "Course with provided ID does not exist."
            ], 400);
        }

        $lesson = new Lesson;
        $position = null;
        if(isset($request->position)===true && Lesson::where("position", "=", $request->position)->exists()===false) {
            // Requested position is available -> ready to use
            $position = $request->position;
        } else { // no position given or position is already taken -> determine max position
            $position = Lesson::max("position");
            // increment, cause at max already one item exists
            $position++;
        }
        $lesson->position = $position;
        $lesson->course_id = $request->course_id;
        $lesson->title = $request->title;
        $lesson->description = $request->description;
        $lesson->predefined_code = $request->predefined_code;
        $lesson->expected_output = $request->expected_output;
        $lesson->xp = $request->xp;
        $lesson->language = $request->language;
        $lesson->save();
    }

    public function update(Request $request, $id) {
        if(Course::where("id", "=", $request->course_id)->exists()===false) {
            return response()->json([
                "success" => false,
                "message" => "Course with provided ID does not exist."
            ], 400);
        }

        if(isset($request->position)===true && Lesson::where("position", "=", $request->position)->exists()===true) {
            return response()->json([
                "success" => false,
                "message" => "Position is already used by another lesson."
            ], 400);
        }

        $lesson = Lesson::find($id);
        $lesson->course_id = $request->course_id;
        $lesson->title = $request->title;
        $lesson->description = $request->description;
        $lesson->predefined_code = $request->predefined_code;
        $lesson->expected_output = $request->expected_output;
        $lesson->xp = $request->xp;
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
