<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Ruta pública de login
Route::post('/auth/login', [AuthController::class, 'login']);

// Rutas públicas para juegos y validación de nickname
Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{id}', [GameController::class, 'show']);
Route::get('/palabra', [WordController::class, 'getRandom']);
Route::get('/users/register/{nickname}', [UserController::class, 'showByNickname']);

// Rutas protegidas para usuarios autenticados
Route::middleware('auth:sanctum')->group(function () {

    // Perfil y logout
    Route::get('/auth/profile', [AuthController::class, 'profile']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Envío de puntuaciones
    Route::post('/scores', [ScoreController::class, 'store']);

    // Rankings
    Route::get('/scores/top', [ScoreController::class, 'globalRanking']);
    Route::get('/scores/global/me', [ScoreController::class, 'userGlobalRanking']);
    Route::get('/scores/game/{id}/top', [ScoreController::class, 'gameRanking']);
    Route::get('/scores/game/{id}/me', [ScoreController::class, 'userGameRanking']);
});

// Rutas para administradores
Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
    Route::post('/games', [GameController::class, 'store']);
    Route::put('/games/{id}', [GameController::class, 'update']);
    Route::patch('/games/{id}/desactivate', [GameController::class, 'desactivate']);
    Route::patch('/games/{id}/activate', [GameController::class, 'activate']);
});
