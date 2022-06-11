<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Course;
use App\Models\FinishedLesson;
use App\Models\Lesson;
use App\Models\User;
use Validator;
use Snipe\BanBuilder\CensorWords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller {
    const MAXIMAL_USERNAME_LENGTH = 30;

    private $censor;
    protected $user;

    public function __construct() {
        $this->middleware("auth:api", ["except" => ["login", "register","forgotpassword", "validatetoken", "test"]]);
        $this->censor = new CensorWords();
        $this->censor->setDictionary(["en-base", "en-us", "en-uk", "de", "es", "fr"]); // load english, german, spanish and french language
        $this->user = new User;
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            "name" => ["required", "string", "max:255", "unique:users", "max:" . self::MAXIMAL_USERNAME_LENGTH, "regex:/^\S*$/u"],  // old regex: /^([a-z])+?(-|_)([a-z])+$/i
            "email" => "required|string|unique:users",
            "password" => "required|min:6|confirmed"
        ]);
        
        if($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->messages()->toArray()
            ], 400);
        }

        // check with dependency for bad words in username now:
        if(($array=$this->censor->censorString($request->name))!==null&&isset($array["matched"])===true&&count($array["matched"])>0) {
            // atleast one bad word found -> block register
            error_log("Arr:" . print_r($array, true));

            return response()->json([
                "success" => false,
                "message" => "Grow up kid."
            ], 400);
        }

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ];

        if(filter_var($data["email"], FILTER_VALIDATE_EMAIL)===false) {
            return response()->json([
                "success" => false,
                "message" => "Invalid E-Mail address format."
            ], 400);
        }

        $this->user->create($data);
        // get user instance
        $user = User::where("email", $data["email"])->first();
        $user->sendWelcomeMail();
        // create token
        return $this->respondWithToken($user->createToken("authToken")->accessToken, "Registration successful", $this->user);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(),[
            "email" => "required|string",
            "password" => "required|min:6",
        ]);

        if($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->messages()->toArray()
            ], 400);
        }

        $credentials = $request->only(["email","password"]);
        $user = User::where("email", $credentials["email"])->first();
        
        if($user) {
            if(!auth()->attempt($credentials)) {
                $responseMessage = "Invalid username or password";
                return response()->json([
                    "success" => false,
                    "message" => $responseMessage,
                    "error" => $responseMessage
                ], 422);
            }
            // $accessToken = auth()->user()->createToken("authToken")->accessToken;
            // $responseMessage = "Login Successful";
            return $this->respondWithToken(auth()->user()->createToken("authToken")->accessToken, "Login successful", auth()->user());
        } else{
            $responseMessage = "User does not exist";
            return response()->json([
                "success" => false,
                "message" => $responseMessage,
                "error" => $responseMessage
            ], 422);
        }
    }

    public function forgotpassword(Request $request) {
        $credentials = $request->only(["email"]);

        if(array_key_exists("email", $credentials)===true) { 
            $user = User::where("email", $credentials["email"])->first();
            
            // for privacy, server won"t reveal if user has been found or not
            if($user) {
                $user->sendPasswordResetMail();
            }
            
            return response()->json([
                "success" => true,
                "message" => "Reset instruction mail has been sent, if entered mail was an existing one.",
            ], 200);
        }
        return response()->json([
            "success" => false,
            "message" => "No email specified.",
        ], 400);
    }

    public function viewprofile() {
        $user = Auth::guard("api")->user();
        $userId = $user->id;

        $xp = 0;

        $achievements = [];
        $achievementsAbove = [];
        $achievementsBelow = [];

        $finishedCourseCache = [];
        $finished_courses = [];

        $started_courses_ids = [];
        $started_courses = [];

        // iterate over all finished courses of user

        // get data from DB
        $finished_lesson_ids = FinishedLesson::select("lesson_id")->where("user_id", $userId)->get()->toArray();

        foreach($finished_lesson_ids as $value) {
            // Data from the finished lesson
            $finishedLessonId = $value["lesson_id"];
            $finishedLesson = Lesson::where("id", $finishedLessonId)->first();
            $lessonTitle = $finishedLesson->title;
            // Data from the course the finished lesson belongs to
            $courseId = $finishedLesson->course_id;
            $course = Course::select("title")->where("id", $courseId)->first();
            
            // sum up XP
            $xp += $finishedLesson->xp;
            // get course ID and determine later courses name
            if(in_array($courseId, $started_courses_ids)===false) $started_courses_ids[] = $courseId;
            // add achievements
            $achievementsBelow[] = "Finished lesson \"$lessonTitle\" from course \"{$course->title}\"";

            // track in finishedCourseCache, later determine if course has been finished or not
            if(in_array($courseId, $finishedCourseCache)===false) {
                $finishedCourseCache[$courseId] = [$finishedLessonId];
            } else $finishedCourseCache[$courseId][] = $finishedLessonId;
        }

        // determine if course has been finished
        foreach($finishedCourseCache as $courseId => $array) {
            $neededCountToComplete = Lesson::where("course_id", $courseId)->get()->count();

            // finished course -> add to finished courses
            if(count($array)===$neededCountToComplete) {
                $course = Course::where("id", $courseId)->first();
                $finished_courses[] = ["id" => $course->id, "title" => $course->title, "description" => $course->description];
            }
            // immediate break, no looping necessary. For-each has only been executed, so key and value can be easily accessed.
            break;
        }

        // gather started courses names
        foreach($started_courses_ids as $id) {
            $course = Course::select("id", "title", "description")->where("id", $id)->first();
            $started_courses[] = ["id" => $course->id, "title" => $course->title, "description" => $course->description];
            $achievementsAbove[] = "Started course \"{$course->title}\"";
        }

        // merge achievments, this is done so that they have a specific order when displayed.
        $achievements = array_merge($achievementsAbove, $achievementsBelow);

        return response()->json([
            "success" => true,
            "message" => "User Profile",
            "data" => [
                "achievemenets" => $achievements,
                "progress" => [
                    "finished_courses" => $finished_courses, 
                    "started_courses" => $started_courses
                ],
                "user" => $user,
                "xp" => $xp
            ]
        ], 200);
    }

    // Prevent middleware from checking by exluding it from it. This is made, so the client gets a unique response, cause the middleware response doesn"t contains success for e. g.
    public function validatetoken(Request $request) {
        $res = Auth::guard("api")->check();

        return response()->json([
            "success" => $res,
            "message" => ($res ? "Token valid" : "Token invalid")
        ], $res ? 200 : 401);
    }

    public function logout() {
        $user = Auth::guard("api")->user()->token();
        $user->revoke();
        return response()->json([
            "success" => true,
            "message" => "Successfully logged out"
        ], 200);
    }
}