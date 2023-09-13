<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/', [PersonController::class, 'store']);
Route::get('/', [PersonController::class, 'index']);
Route::get('/{user_id}', [PersonController::class, 'show']);
Route::put('/{user_id}', [PersonController::class, 'update']);
Route::delete('/{user_id}', [PersonController::class, 'destroy']);
