<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if(!auth()->guard('student')->attempt($credentials)){
            return response(['message' => "Failed to log in"], Response::HTTP_UNAUTHORIZED);
        }
    
        // return $user = $request->user('student'); // this works too
        $user = auth()->guard('student')->user();
        $token = $user->createToken('Access Token')->plainTextToken;
    
    
        return response()->json([
            'Token' => $token,
            'User' => $user
        ]);
    }

    public function logout(Request $request)
    {
        // $user->tokens()->delete(); // this works too
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Log out successful!'
        ]);
    }

    public function refresh(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'access_token' => $request->user()->createToken('Refreshed Token')->plainTextToken,
        ]);
    }

    

    public function get_notification(Request $request)
    {
        return $request->user()->unreadNotifications;
    }

    public function show_notification(Request $request, $id)
    {   
        //$request->user(); this works too
        if($notification = auth()->user()->notifications()->where('id', $id)->first()){

            $notification->markAsRead();
            return response()->json([
                'status' => true,
                'notification' => $notification
            ]);
        }
        // return $request->user()->notifications->markAsRead();
    }

}
