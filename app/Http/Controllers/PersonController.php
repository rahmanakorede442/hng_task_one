<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Person;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Person::all();
        return response()->json([
            'data' => $data
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request)
    {
        $person = Person::query()->create([
            'name' => $request->name,
        ]);
        return response()->json([
            'message' => 'Record created!',
            'person' => $person
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $person = Person::findOrFail($id);
        } catch (Throwable $th) {
            return response(['message' => 'No record found'], 404);
        }
        return response()->json([
            'person' => $person,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, $id)
    {
        try {
            $person = Person::query()->findOrFail($id);
        } catch (Throwable $th) {
            return response(['message' => 'No record found'], 404);
        }

        $person->update([
            'name' => $request->only('name') ?? $person->name
        ]);

        if($person){
            return response(['message' => 'Record updated!'], 200);
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
            return response(['message' => 'No record found!'], 404);
        }

        $person->forceDelete();
        return response(['message' => 'Deleted!'], 200);
    }
}
