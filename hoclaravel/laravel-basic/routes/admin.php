<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/roles/{id}', [RoleController::class, 'find']);
Route::post('/roles', [RoleController::class, 'create']);
Route::put('/roles/{id}', [RoleController::class, 'update']);
Route::delete('/roles/{id}', [RoleController::class, 'delete']);
Route::post('/roles/{id}/users', [RoleController::class, 'addUsers']);
Route::delete('/roles/{id}/users', [RoleController::class, 'deleteUsers']);

//restful api