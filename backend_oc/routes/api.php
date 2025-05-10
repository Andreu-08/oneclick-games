<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function (){

    //Rutas para auth, ver perfil y logout
    Route::get('/auth/profile', [AuthController::class, 'profile']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    //ruta para eliminar tu cuenta
    Route::delete('/users/me', [UserController::class, 'destroy']);

    //rutas para gestionar juegos desde el admin
    Route::post('/games', [GameController::class, 'store']);
    Route::put('/games/{id}', [GameController::class, 'update']);
    Route::patch('/games/{id}/desactivate', [GameController::class, 'desactivate']);
    Route::patch('/games/{id}/activate', [GameController::class, 'activate']);
});



//Rutas publicas para los usuarios
Route::get('/users',[UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

//Rutas publicas para los juegos
Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{id}', [GameController::class, 'show']);
