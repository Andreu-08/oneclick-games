<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Score;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nickname',
        'is_admin',
        'pin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pin',
        'is_admin',
    ];

    /**
     * Relación: un usuario tiene muchas puntuaciones.
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    /**
     * Comprueba si el usuario es administrador.
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }
}
