<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseController;
//use App\Http\Controllers\CodeController;

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

//Route::post('run', [CodeController::class, 'run']);
Route::get('course/recent', [CourseController::class, 'recent']);
Route::get('course/{id}/lessons', [CourseController::class, 'lessons']);
Route::apiResource('course', CourseController::class);
Route::apiResource('course.lesson', LessonController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
