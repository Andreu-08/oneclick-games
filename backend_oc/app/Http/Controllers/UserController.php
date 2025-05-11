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
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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

}
