<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Score;
use Illuminate\Support\Str;

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

    //genera automaticamnte la url que utilizara el jeugo apartir de su titulo
    protected static function booted()
    {
        static::creating(function ($game) {
            if (empty($game->url)) {
                $game->url = Str::slug($game->title);
            }
        });
    }
}
