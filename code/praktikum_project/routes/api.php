<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CodeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// auth API routes
Route::group(["prefix" => "users", "middleware" => "CORS"], function($router) {
    // GET
    Route::get("/view-profile", [UserController::class, "viewprofile"])->name("profile.user");
    Route::get("/validate-token", [UserController::class, "validatetoken"])->name("validatetoken.user");
    Route::get("/logout", [UserController::class, "logout"])->name("logout.user");
    // POST
    Route::post("/register", [UserController::class, "register"])->name("register.user");
    Route::post("/forgotpassword", [UserController::class, "forgotpassword"])->name("forgotpassword.user");
    Route::post("/login", [UserController::class, "login"])->name("login.user");
});

Route::group(["middleware" => "auth:api"], function() {
    // code execution routes
    Route::post("run", [CodeController::class, "run"]);

    // course routes
    Route::get("/course/recent", [CourseController::class, "recent"]);
    Route::get("/lesson/{lesson_id}/finished", [LessonController::class, "finished"]);
    Route::apiResource("course", CourseController::class);
    // lesson routes
    Route::apiResource("course.lesson", LessonController::class);
    Route::post("/lesson/get-next-lesson", [LessonController::class, "nextLesson"]);
});
