<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/person', [PersonController::class, 'store']);
Route::get('/person', [PersonController::class, 'index']);
Route::get('/person/{user_id}', [PersonController::class, 'show']);
Route::put('/person/{user_id}', [PersonController::class, 'update']);
Route::delete('/person/{user_id}', [PersonController::class, 'destroy']);
