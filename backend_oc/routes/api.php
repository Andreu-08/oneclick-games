<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/users',[UserController::class, 'index']);


Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function (){

    Route::get('/auth/profile', [AuthController::class, 'profile']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::delete('/users/me', [UserController::class, 'destroy']);

    Route::post('/games', [GameController::class, 'store']);
    Route::put('/games/{id}', [GameController::class, 'update']);
    Route::delete('/games/{id}', [GameController::class, 'destroy']);


});

Route::get('/users/{id}', [UserController::class, 'show']);


Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{id}', [GameController::class, 'show']);
