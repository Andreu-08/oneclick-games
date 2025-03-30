<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //funcion que inicia sesion y si no existe el usuario lo crea
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos inválidos',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Buscar usuario por email
        $user = User::where('email', $request->email)->first();

        // Si no existe, lo creamos
        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => 'default', // Hasheado automáticamente por el modelo
            ]);
        }

        // Generar token personal
        $token = $user->createToken('access_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ],Response::HTTP_ACCEPTED);
    }

    //funcion para mostrar el perfil del usuario logead
    public function profile(Request $request)
    {
        return response()->json($request->user(),Response::HTTP_OK);
    }

    //funcion para cerrar la sesion del usuario
    public function logout(Request $request)
    {
        //Eliminar el token de sesion actual
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente'],Response::HTTP_OK);
    }
}

