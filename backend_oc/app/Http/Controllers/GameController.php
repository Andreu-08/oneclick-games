<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //index para listar todos los juegos
    public function index()
    {
        $games = Game::where('is_active', true)
            ->select('id', 'title', 'description', 'url', 'difficulty_levels')
            ->get();

        return response()->json($games);
    }

    //muestra un juego en especifico
    public function show($id)
    {
        $game = Game::findOrFail($id);

        return response()->json([
            'id' => $game->id,
            'title' => $game->title,
            'description' => $game->description,
            'url' => $game->url,
            'difficulty_levels' => $game->difficulty_levels,
            'is_active' => $game->is_active,
            'created_at' => $game->created_at,
        ]);
    }

    //funcion para crear un juego desde el admin
    public function store(Request $request)
    {

        // Validar los datos de entrada
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'difficulty_levels' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        //Crea el juego
        $game = Game::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'difficulty_levels' => $validated['difficulty_levels'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return response()->json([
            'message' => 'Juego creado correctamente',
            'game' => $game
        ], 201);
    }

    //funcion para crear un juego desde el admin
    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'difficulty_levels' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $game->update($validated);

        return response()->json([
            'message' => 'Juego actualizado correctamente',
            'game' => $game
        ]);
    }

    //funcion para desactivar un juego desde el admin
    public function desactivate($id)
    {
        $game = Game::findOrFail($id);

        $game->is_active = false;
        $game->save();

        return response()->json([
            'message' => 'Juego desactivado correctamente'
        ]);
    }

    public function activate($id)
    {
        $game = Game::findOrFail($id);

        if ($game->is_active) {
            return response()->json(['message' => 'El juego ya está activo.'], 400);
        }

        $game->is_active = true;
        $game->save();

        return response()->json([
            'message' => 'Juego reactivado correctamente',
            'game' => $game
        ]);
    }
}
