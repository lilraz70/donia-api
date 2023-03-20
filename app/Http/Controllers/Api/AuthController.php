<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SetCountry;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        // return response()->json("oui");
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'username' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'set_countries_id' => 'required'
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'set_countries_id' => $request->set_countries_id,
            'password' => bcrypt($request->password),
        ]);

        $user->roles()->attach(2); // Simple user role

        return response()->json($user);
    }

    //
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Les données fournies n\'étaient pas valides.',
                'errors' => [
                    'password' => [
                        'Informations d\'identification non valides'
                    ],
                ]
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        $authToken = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'access_token' => $authToken,
        ]);
    }

    //
    public function loginphone(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $credentials = request(['phone', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Les données fournies n\'étaient pas valides.',
                'errors' => [
                    'password' => [
                        'Informations d\'identification non valides'
                    ],
                ]
            ], 422);
        }

        $user = User::where('phone', $request->phone)->first();
        $authToken = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'access_token' => $authToken,
        ]);
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $user->tokens()->delete();
            return response()->json([
                "success" => true,
                'message' => 'Déconnexion réussie'
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
