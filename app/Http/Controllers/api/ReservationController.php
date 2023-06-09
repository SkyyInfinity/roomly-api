<?php

namespace App\Http\Controllers\api;

use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();

        if(count($reservations) === 0) {
            return response()->json([
                'message' => 'Aucune réservation n\'a été trouvée.'
            ]);
        }

        foreach($reservations as $reservation) {
            $user = User::findOrFail($reservation->user);
            $room = Room::findOrFail($reservation->room);

            $reservation->user = $user;
            $reservation->room = $room;
        }

        return response()->json($reservations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request)
    {
        $user = User::findOrFail($request->user);
        $room = Room::findOrFail($request->room);

        $reservation = Reservation::create([
            'user' => $user->id,
            'room' => $room->id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at
        ]);

        return response()->json([
            'message' => 'La réservation a été créée avec succès.',
            'reservation' => [
                'id' => $reservation->id,
                'user' => $reservation->user,
                'room' => $reservation->room,
                'status' => $reservation->status,
                'start_at' => $reservation->start_at,
                'end_at' => $reservation->end_at
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Reservation::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update([
            'user' => $request->user ? $request->user : $reservation->user,
            'room' => $request->room ? $request->room : $reservation->room,
            'status' => $request->status ? $request->status : $reservation->status,
            'start_at' => $request->start_at ? $request->start_at : $reservation->start_at,
            'end_at' => $request->end_at ? $request->end_at : $reservation->end_at
        ]);

        return response()->json([
            'message' => 'La réservation a été modifiée avec succès.',
            'reservation' => $reservation
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

        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json([
            'message' => 'La réservation a été supprimée avec succès.'
        ]);
    }
}
