<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Score;

class Game extends Model
{
    use HasFactory;

    /**
     * Atributos asignables en masa.
     */
    protected $fillable = [
        'title',
        'description',
        'is_active',
        'difficulty_levels',
    ];

    /**
     * Casts para convertir datos automáticamente.
     */
    protected $casts = [
        'is_active' => 'boolean',
        'difficulty_levels' => 'array', // JSON como array asociativo
    ];

    /**
     * Relación: un juego tiene muchas puntuaciones.
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
