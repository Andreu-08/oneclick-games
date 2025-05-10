<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

//Ruta pública de login
Route::post('/auth/login', [AuthController::class, 'login']);

//Rutas públicas para ver juegos y usuarios
Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{id}', [GameController::class, 'show']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

//Rutas para usuarios autenticados (con token válido)
Route::middleware('auth:sanctum')->group(function () {

    //Perfil y logout
    Route::get('/auth/profile', [AuthController::class, 'profile']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    //Eliminar cuenta
    Route::delete('/users/me', [UserController::class, 'destroy']);

    //Puntuaciones del usuario
    Route::post('/scores', [ScoreController::class, 'store']);
    Route::get('/scores/user/{user_id}', [ScoreController::class, 'userScores']);
    Route::get('/scores/game/{game_id}', [ScoreController::class, 'gameScores']);
    Route::get('/scores/game/{id}/top', [ScoreController::class, 'topScores']);
    Route::get('/scores/top', [ScoreController::class, 'globalRanking']);
});

//Rutas solo para administradores autenticados
Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
    Route::post('/games', [GameController::class, 'store']);
    Route::put('/games/{id}', [GameController::class, 'update']);
    Route::patch('/games/{id}/desactivate', [GameController::class, 'desactivate']);
    Route::patch('/games/{id}/activate', [GameController::class, 'activate']);
});
