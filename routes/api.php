<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\StudentController;
use App\Models\Admin;
use App\Models\Student;

Route::post('/', [PersonController::class, 'store']);
Route::get('/', [PersonController::class, 'index']);
Route::get('/{user_id}', [PersonController::class, 'show']);
Route::put('/{user_id}', [PersonController::class, 'update']);
Route::delete('/{user_id}', [PersonController::class, 'destroy']);



Route::post('user/login', [PersonController::class,'login']);
Route::post('student/login', [StudentController::class,'login']);
Route::post('admin/login', [AdminController::class,'login']);



Route::post('notify', [PersonController::class, 'send_notification']);


Route::middleware('auth:sanctum')->group(function (){

    Route::prefix('user')->group(function(){

        Route::get('read-notification/{id}', [PersonController::class, 'show_notification']);
        Route::get('notifications', [PersonController::class, 'get_notification']);

        Route::get('logout', [PersonController::class, 'logout']);
        Route::get('refresh', [PersonController::class, 'refresh']);

    });

    Route::prefix('admin')->group(function(){

        Route::get('read-notification/{id}', [AdminController::class, 'show_notification']);
        Route::get('notifications', [AdminController::class, 'get_notification']);

        Route::get('logout', [AdminController::class, 'logout']);
        Route::get('refresh', [AdminController::class, 'refresh']);
    });

    Route::prefix('student')->group(function(){

        Route::get('read-notification/{id}', [StudentController::class, 'show_notification']);
        Route::get('notifications', [StudentController::class, 'get_notification']);

        Route::get('logout', [StudentController::class, 'logout']);
        Route::get('refresh', [StudentController::class, 'refresh']);
    });


});
