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

// auth API routes
 
/*Route::post('/register',[AuthController::class,'catchRegistriationTry']); 
Route::post('/login',[AuthController::class,'login']);*/

Route::group(['prefix' => 'users', 'middleware' => 'CORS'], function ($router) {
    Route::post('/register', [UserController::class, 'register'])->name('register.user');
    Route::post('/login', [UserController::class, 'login'])->name('login.user');
    Route::post('/forgotpassword', [UserController::class, 'forgotpassword'])->name('forgotpassword.user');
    Route::get('/view-profile', [UserController::class, 'viewProfile'])->name('profile.user');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout.user');
});

// course routes
Route::get('course/recent', [CourseController::class, 'recent']);
Route::apiResource('course', CourseController::class);
Route::apiResource('course.lesson', LessonController::class);