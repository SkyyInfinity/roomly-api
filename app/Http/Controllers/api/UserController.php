<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Controllers\AuthController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(['id', 'first_name', 'last_name', 'email', 'roles', 'created_at', 'updated_at']);

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
    public function update(Request $request, User $user)
    {
        // Update an user
        $user->update([
            'first_name' => $request->first_name ? $request->first_name : $user->first_name,
            'last_name' => $request->last_name ? $request->last_name : $user->last_name,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return response()->json([
            'message' => 'L\'utilisateur a été mis à jour avec succès.',
            'user' => $user
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
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'L\'utilisateur à bien été supprimé.'
        ]);
    }
}
