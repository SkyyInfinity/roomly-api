<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $credentials = $request->only(['email', 'password']);

        if(!$token = auth()->attempt($credentials)) {
            // Store token in database in remember_token column
            $user = User::where('email', $request->email)->first();
            $user->update([
                'remember_token' => $token
            ]);
            
            return response()->json([
                'message' => 'Identifiants invalides.'
            ], 401);
        }

        return response()->json([
            'token' => $token,
            'type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 120, // 120 minutes
            'user' => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Vous avez été déconnecté.'
        ]);
    }

    public function refresh()
    {
        $token = auth()->refresh();

        return response()->json([
            'token' => $token,
            'type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 120, // 120 minutes
            'user' => auth()->user()
        ]);
    }

    public function isRole(string $role): bool
    {
        if(in_array($role, json_decode(auth()->user()->roles))) {
            return true;
        }

        return false;
    }

    public function isLoggedIn()
    {
        // check if user exist
        if(auth()->check()) {
            return true;
        }

        return false;

    }
}
