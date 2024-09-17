<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actors = Actor::all();
        return response()->json($actors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $actor = new Actor();
        $actor->first_name = $request->input('first_name');
        $actor->last_name = $request->input('last_name');
        $actor->save();

        return response()->json($actor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $actor = Actor::findOrFail($id);
        return response()->json($actor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $actor = Actor::findOrFail($id);
        $actor->first_name = $request->input('first_name');
        $actor->last_name = $request->input('last_name');
        $actor->save();

        return response()->json($actor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $actor = Actor::findOrFail($id);
        $actor->delete();

        return response()->json(['message' => 'Actor eliminado correctamente']);
    }
}
