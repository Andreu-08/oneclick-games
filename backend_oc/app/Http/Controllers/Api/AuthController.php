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
            'nickname'    => 'required|string|max:255',
            'pin'         => 'required|digits:4'
        ]);

        // Buscar usuario por nickname
        $user = User::where('nickname', $request->nickname)->first();

        if ($user) {
            // Intentar iniciar sesión si el usuario existe
            if (!Hash::check($request->pin, $user->pin)) {
                return response()->json(['message' => 'PIN incorrecto.'], 401);
            }
        } else {
            // Si no existe, lo registramos automáticamente
            $user = User::create([
                'nickname' => $request->nickname,
                'pin'      => Hash::make($request->pin),
            ]);
        }

        // Generar token de sesión
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => [
                'id'       => $user->id,
                'nickname' => $user->nickname,
            ],
        ]);
    }

    //Ruta para hacer el logout desde la Api
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }

    //Ruta para acceder a la infomacion del usuario autenticado
    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }
}
