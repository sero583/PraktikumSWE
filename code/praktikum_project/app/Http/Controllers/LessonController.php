<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\FinishedLesson;

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

    public function nextLesson(Request $request) {
        if(isset($request->course_id)===false||isset($request->lesson_position)===false) {
            return response()->json([
                "success" => false,
                "message" => "Field course_id or lesson_position is missing."
            ], 400);
        }

        if(is_numeric($request->course_id)===false||is_numeric($request->lesson_position)===false) {
            return response()->json([
                "success" => false,
                "message" => "Values must be numeric."
            ], 400);
        }

        $nextPos = Lesson::where([["course_id", "=", $request->course_id], ["position", ">", $request->lesson_position], ["deleted_at", "=", null]])->first();

        if($nextPos!==null) {
            // TODO depend if same id
            $requestedPos = $request->lesson_position;

            if($request->lesson_position!==$nextPos->lesson_position) {
                return response()->json([
                    "success" => true,
                    "hasNext" => true,
                    "lesson" => $nextPos
                ], 200);
            } else return response()->json([
                "success" => true,
                "hasNext" => false
            ], 200);
        }
        return response()->json([
            "success" => true,
            "hasNext" => false
        ], 200);
    }

    public function finished($lesson_id){
        if(FinishedLesson::where([["lesson_id", $lesson_id], ["user_id", Auth::user()->id]])->exists() === true){
            return'{"finished": true}';
        }
        else{
            return'{"finished": false}';
        }
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
        $lesson->tester_code = $request->tester_code;
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
