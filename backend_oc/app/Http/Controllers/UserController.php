<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response($users, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $user = User::findOrFail($id);

        return response()->json([
            'id'    => $user->id,
            'name'  => $user->name,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        // Elimina el usuario
        $user->delete();

        // Revoca el token activo
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Cuenta eliminada correctamente y sesión cerrada.'
        ]);
    }

    public function showByNickname($nickname)
    {
        $user = User::where('nickname', $nickname)->first();
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json([
            'id' => $user->id,
            'nickname' => $user->nickname,
        ]);
    }
}
