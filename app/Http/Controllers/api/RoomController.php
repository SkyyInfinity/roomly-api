<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomStoreRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();

        if(count($rooms) === 0) {
            return response()->json([
                'message' => 'Aucune salle n\'a été trouvée.'
            ]);
        }

        return response()->json($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomStoreRequest $request)
    {
        // Store a new room
        $room = Room::create([
            'name' => ucfirst($request->name),
            'description' => ucfirst($request->description),
            'image' => $request->image,
            'pin' => $request->is_reserved || null,
            'is_reserved' => $request->is_reserved || false
        ]);

        return response()->json([
            'message' => 'La salle a été créée avec succès.',
            'room' => $room
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Room::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Store a new room
        $room = Room::create([
            'name' => ucfirst($request->name),
            'description' => ucfirst($request->description),
            'image' => $request->image,
            'pin' => $request->is_reserved || null,
            'is_reserved' => $request->is_reserved || false
        ]);

        return response()->json([
            'message' => 'La salle a été créée avec succès.',
            'room' => $room
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete an user
        $room = Room::findOrFail($id);
        $room->delete();

        return response()->json([
            'message' => 'La salle a bien été supprimée.'
        ]);
    }
}
