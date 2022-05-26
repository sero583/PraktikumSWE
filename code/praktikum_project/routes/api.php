<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;


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


Route::get("test", [UserController::class, "test"])->name("test.user");

// course routes
Route::get("course/recent", [CourseController::class, "recent"]);
Route::apiResource("course", CourseController::class);
Route::apiResource("course.lesson", LessonController::class);

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