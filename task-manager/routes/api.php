<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/priority', [TaskController::class, 'getPriority']);

Route::get('/tasks/{id}', [TaskController::class, 'find']);

Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{id}', [TaskController::class, 'edit']);
Route::delete('/tasks/{id}', [TaskController::class, 'delete']);


