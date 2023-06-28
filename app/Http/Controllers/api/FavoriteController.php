<?php

namespace App\Http\Controllers\api;

use App\Models\Room;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FavoriteStoreRequest;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string|int $id)
    {
        $favorites = Favorite::all()->where('user_id', $id);

        if(count($favorites) === 0) {
            return response()->json([
                'message' => 'Aucun favoris n\'a été trouvée pour cet utilisateur.'
            ]);
        }
        foreach($favorites as $favorite) {
            $user = User::findOrFail($favorite->user_id);
            $room = Room::findOrFail($favorite->room_id);

            $favorite->user = $user;
            $favorite->room = $room;
        }

        return response()->json($favorites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FavoriteStoreRequest $request)
    {
        $user = User::findOrFail($request->user_id);
        $room = Room::findOrFail($request->room_id);

        $favorite = Favorite::create([
            'user_id' => $user->id,
            'room_id' => $room->id
        ]);

        return response()->json([
            'message' => 'Le favoris a été créée avec succès.',
            'favorite' => [
                'id' => $favorite->id,
                'user_id' => $favorite->user_id,
                'room_id' => $favorite->room_id
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Favorite::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favorite)
    {
        $favorite->update([
            'user_id' => $request->user_id ? $request->user_id : $favorite->user_id,
            'room_id' => $request->room_id ? $request->room_id : $favorite->room_id
        ]);

        return response()->json([
            'message' => 'Le favoris a été modifié avec succès.',
            'favorite' => $favorite
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

        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return response()->json([
            'message' => 'Le favoris a été supprimé avec succès.'
        ]);
    }
}