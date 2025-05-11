<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    // Función para almacenar una puntuación
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'score' => 'required|integer|min:0',
            'duration' => 'nullable|integer|min:0',
            'meta' => 'nullable|array',
        ]);

        $score = Score::create([
            'user_id' => $request->user()->id,
            'game_id' => $validated['game_id'],
            'score' => $validated['score'],
            'duration' => $validated['duration'] ?? null,
            'meta' => $validated['meta'] ?? null,
        ]);

        return response()->json([
            'message' => 'Puntuación guardada',
            'score' => $score
        ], 201);
    }

    // Devuelve las puntuaciones de un usuario
    public function userScores($user_id)
    {
        $user = User::findOrFail($user_id);

        $scores = Score::where('user_id', $user_id)
            ->with('game:id,title,url')
            ->orderByDesc('score')
            ->get();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'nickname' => $user->nickname,
            ],
            'scores' => $scores
        ]);
    }

    // Devuelve todas las puntuaciones de un juego
    public function gameScores($game_id)
    {
        $game = Game::findOrFail($game_id);

        $scores = $game->scores()
            ->with('user:id,nickname')
            ->orderByDesc('score')
            ->get();

        return response()->json([
            'game' => [
                'id' => $game->id,
                'title' => $game->title,
                'url' => $game->url,
            ],
            'scores' => $scores
        ]);
    }

    // Devuelve el top 10 de puntuaciones de un juego
    public function topScores($id)
    {
        $game = Game::findOrFail($id);

        $scores = $game->scores()
            ->with('user:id,nickname')
            ->orderByDesc('score')
            ->limit(10)
            ->get();

        return response()->json([
            'game' => [
                'id' => $game->id,
                'title' => $game->title,
                'url' => $game->url,
            ],
            'top_scores' => $scores
        ]);
    }

    // Devuelve el ranking global sumando puntuaciones de todos los juegos
    public function globalRanking(Request $request)
    {
        $limit = $request->query('limit', 10);

        $ranking = Score::select('user_id')
            ->selectRaw('SUM(score) as total_score')
            ->with('user:id,nickname')
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->limit($limit)
            ->get()
            ->map(function ($score) {
                return [
                    'id' => $score->user->id,
                    'nickname' => $score->user->nickname,
                    'total_score' => $score->total_score,
                ];
            });

        return response()->json([
            'ranking' => $ranking
        ]);
    }
}
