<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    // Almacena una nueva puntuación
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

    // Ranking global (sumando puntuaciones de todos los juegos)
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

    // Ranking global del usuario actual
    public function userGlobalRanking(Request $request)
    {
        $userId = $request->user()->id;

        $ranking = Score::select('user_id')
            ->selectRaw('SUM(score) as total_score')
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->get();

        $position = $ranking->search(fn($row) => $row->user_id == $userId) + 1;
        $totalScore = $ranking->firstWhere('user_id', $userId)?->total_score ?? 0;

        return response()->json([
            'id' => $userId,
            'nickname' => $request->user()->nickname,
            'total_score' => $totalScore,
            'position' => $position
        ]);
    }

    // Ranking del juego: Top 10 usuarios con mayor puntuación sumada en ese juego
    public function gameRanking($id)
    {
        $game = Game::findOrFail($id);

        $ranking = Score::where('game_id', $game->id)
            ->select('user_id')
            ->selectRaw('SUM(score) as total_score')
            ->with('user:id,nickname')
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->limit(10)
            ->get()
            ->map(function ($entry) {
                return [
                    'id' => $entry->user->id,
                    'nickname' => $entry->user->nickname,
                    'total_score' => $entry->total_score,
                ];
            });

        return response()->json([
            'ranking' => $ranking
        ]);
    }

    // Puntuación total del usuario logueado en un juego concreto
    public function userGameRanking(Request $request, $gameId)
    {
        $userId = $request->user()->id;

        $totalScore = Score::where('user_id', $userId)
            ->where('game_id', $gameId)
            ->sum('score');

        return response()->json([
            'id' => $userId,
            'nickname' => $request->user()->nickname,
            'total_score' => $totalScore,
        ]);
    }
}
