<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('hng_slack', function (Request $request){
    return response()->json([
        'slack_name' => $request->slack_name,
        'current_day' => date('m'),
        'utc_time' => date('Y-m-d h:i:s'),
        'track' => $request->track,
        'github_file_url' => 'git@github.com:rahmanakorede442/hng_task_one.git',
        'github_repo_url' => 'git@github.com:rahmanakorede442/hng_task_one.git',
        'status_code' => 200
    ]);
});