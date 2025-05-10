<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    //funcion para el login del usuario mediante name y pin
    public function login(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'pin'        => 'required|digits:4',
            'is_register'=> 'required|boolean',
            'email'      => 'nullable|required_if:is_register,true|email'
        ]);

        if ($request->is_register) {
            // Intentar registrar un nuevo usuario
            $exists = User::where('name', $request->name)->first();
            if ($exists) {
                return response()->json(['message' => 'El nombre de usuario ya está registrado.'], 409);
            }

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make(Str::random(16)),
                'pin'      => Hash::make($request->pin),
            ]);
        } else {
            // Intentar iniciar sesión con nombre y pin
            $user = User::where('name', $request->name)->first();

            if (!$user || !Hash::check($request->pin, $user->pin)) {
                return response()->json(['message' => 'Credenciales incorrectas.'], 401);
            }
        }

        // Token para ambos casos
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ],
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }


}
