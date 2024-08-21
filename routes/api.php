<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\CategoryController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('/tasks', TasksController::class);
Route::post('/validate-username', [TasksController::class, 'validateUsername']);
Route::post('/validate-email', [TasksController::class, 'validateEmail']);

Route::get('/categories', [CategoryController::class, 'index']);
