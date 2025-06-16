<?php

use Architecture\Task\Controller\TaskController;
use Architecture\User\Controller\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Controllers de Users
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// Controllers de Tasks
Route::post('/tasks', [TaskController::class, 'register'])
        ->middleware('auth:sanctum');

Route::get('/tasks/{id}', [TaskController::class, 'getAll'])
    ->middleware('auth:sanctum');
