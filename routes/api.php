<?php

use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/validate-username', [TasksController::class, 'validateUsername']);
Route::post('/validate-email', [TasksController::class, 'validateEmail']);
Route::apiResource('/tasks', TasksController::class);
