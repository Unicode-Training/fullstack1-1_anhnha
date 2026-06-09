<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\CheckOnlyAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/users', [UserController::class, 'index'])->middleware('permission:users.list');
Route::get('/products', [ProductController::class, 'index'])->middleware("permission:products.list");

Route::group(['middleware' => CheckOnlyAdminMiddleware::class],function() {
    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/{id}', [RoleController::class, 'find']);
    Route::post('/roles', [RoleController::class, 'create']);
    Route::put('/roles/{id}', [RoleController::class, 'update']);
    Route::delete('/roles/{id}', [RoleController::class, 'delete']);
    Route::put('/roles/{id}/users', [RoleController::class, 'updateUsers']);
    Route::get('/roles/{id}/users', [RoleController::class, 'getUsers']);
});


//restful api