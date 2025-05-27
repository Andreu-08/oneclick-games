<?php

namespace App\Http\Controllers;

use App\Models\Word;

class WordController extends Controller
{
    public function getRandom()
    {
        // Seleccionamos una palabra al azar
        $palabra = Word::inRandomOrder()->first();

        // Devolvemos solo la palabra como texto
        return response()->json([
            'word' => $palabra->word
        ]);
    }
}
