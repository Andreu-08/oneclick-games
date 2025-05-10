<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //index para listar todos los jeugos
    public function index()
    {
        $games = Game::where('is_active', true)
            ->select('id', 'title', 'description', 'url', 'difficulty_levels')
            ->get();

        return response()->json($games);
    }

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
}
