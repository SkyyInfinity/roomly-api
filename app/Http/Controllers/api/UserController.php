<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        if(count($users) === 0) {
            return response()->json([
                'message' => 'Aucun utilisateur n\'a été trouvé.'
            ]);
        }

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        // Store a new user
        $user = User::create([
            'first_name' => ucfirst($request->first_name),
            'last_name' => ucfirst($request->last_name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => json_encode(['user'])
        ]);

        return response()->json([
            'message' => 'L\'utilisateur a été créé avec succès.',
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, User $user)
    {
        // Update an user
        $user->update([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'L\'utilisateur a été mis à jour avec succès.',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete an user
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'L\'utilisateur à bien été supprimé.'
        ]);
    }
}
