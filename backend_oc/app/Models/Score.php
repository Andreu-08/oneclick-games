<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Game;

class Score extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden asignar en masa.
     */
    protected $fillable = [
        'user_id',
        'game_id',
        'score',
        'meta',
        'duration',
    ];

    /**
     * Casts para campos especiales.
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * Relación: un score pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: un score pertenece a un juego.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
