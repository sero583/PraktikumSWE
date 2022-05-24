<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseController;

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

// authentication routes
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
 
Route::post('/register',[UserController::class,'catchRegistriationTry']); 
Route::post('/login',[UserController::class,'login']);

// course routes
Route::get('course/recent', [CourseController::class, 'recent']);
Route::apiResource('course', CourseController::class);
Route::apiResource('course.lesson', LessonController::class);
 
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
