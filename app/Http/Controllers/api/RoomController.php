<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomStoreRequest;
use App\Models\Favorite;
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
     * Display a listing of the resource with favorites.
     */
    public function getAllWithFavorites(string|int $id = null) 
    {
        $rooms = Room::all();

        if(count($rooms) === 0) {
            return response()->json([
                'message' => 'Aucune salle n\'a été trouvée.'
            ]);
        }

        if($id) {
            $favorites = Favorite::all()->where('user_id', $id);

            foreach($rooms as $room) {
                foreach($favorites as $favorite) {
                    if($room->id === $favorite->room_id) {
                        $room->is_favorite = true;
                        $room->favorite_id = $favorite->id;
                    }
                }
            }
        }

        return response()->json($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomStoreRequest $request)
    {
        if(in_array('admin', json_decode($request->user()->roles)) === false) {
            return response()->json([
                'message' => 'Vous n\'avez pas les droits pour accéder à cette ressource.'
            ]);
        }

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
    public function update(Request $request, Room $room)
    {
        if(in_array('admin', json_decode($request->user()->roles)) === false) {
            return response()->json([
                'message' => 'Vous n\'avez pas les droits pour accéder à cette ressource.'
            ]);
        }
        
        // Store a new room
        $room->update([
            'name' => $request->name ? ucfirst($request->name) : $room->name,
            'description' => $request->description ? ucfirst($request->description) : $room->description,
            'image' => $request->image ? $request->image : $room->image,
            'pin' => $request->is_reserved ? $request->is_reserved : $room->pin,
            'is_reserved' => $request->is_reserved ? $request->is_reserved : $room->is_reserved
        ]);

        return response()->json([
            'message' => 'La salle a été mise à jour avec succès.',
            'room' => $room
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if(in_array('admin', json_decode($request->user()->roles)) === false) {
            return response()->json([
                'message' => 'Vous n\'avez pas les droits pour accéder à cette ressource.'
            ]);
        }

        // Delete an user
        $room = Room::findOrFail($id);
        $room->delete();

        return response()->json([
            'message' => 'La salle a bien été supprimée.'
        ]);
    }
}
