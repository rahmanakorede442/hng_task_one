<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\Admin;
use App\Models\Person;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Notifications\WelcomeNotification;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Person::query()->oldest('id')->get();
        return response(['data' => $data], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request)
    {
        $person = Person::query()->create([
            'name' => $request->name,
        ]);
        return response($person, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $person = Person::findOrFail($id);
        } catch (Throwable $th) {
            return response(['error' => 'No record found'], 404);
        }
        return response($person, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, $id)
    {
        try {
            $person = Person::query()->findOrFail($id);
        } catch (Throwable $th) {
            return response(['error' => 'No record found'], 404);
        }

        $person->update([
            'name' => $request->name ?? $person->name
        ]);

        if($person){
            return response([
                'message' => 'Record updated!'
        ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $person = Person::query()->findOrFail($id);
        } catch (Throwable $th) {
            return response(['error' => 'No record found!'], 404);
        }

        $person->forceDelete();
        return response(['message' => "Person with Id $id has been deleted!"], 200);
    }


    public function send_notification()
    {

        try {
            $user = User::find(1);
            $user->notify(new WelcomeNotification($user));

            return response()->json([
                'status' => true,
                'message' => 'Notification sent'
            ]);

        } catch (\Exception $th) {

            return response()->json([
                'status' => false,
                'message' => 'could not send notification due to:'. $th->getMessage(),
            ]);
        }

    }

    public function get_notification(Request $request)
    {
        return $request->user()->unreadNotifications;
    }

    public function show_notification(Request $request, $id)
    {
        
        if($notification = auth()->user()->notifications()->where('id', $id)->first()){
            $notification->markAsRead();
            return response()->json([
                'status' => true,
                'notification' => $notification
            ]);
        }
        // return $request->user()->notifications->markAsRead();
    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if(!auth()->attempt($credentials)){
            return response(['message' => "Failed to log in"], Response::HTTP_UNAUTHORIZED);
        }

        // return $user = $request->user(); // this works too
        $user = auth()->guard()->user();
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
    
}
