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
}
