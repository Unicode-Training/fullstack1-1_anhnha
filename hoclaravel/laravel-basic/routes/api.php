<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'find']);
Route::middleware(AuthMiddleware::class)->group(function () {
    Route::post('/products', [ProductController::class, 'create']);
    Route::patch('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'delete']);
});

Route::apiResource('photos', PhotoController::class);

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::get('/auth/profile', [AuthController::class, 'profile'])->middleware(AuthMiddleware::class);
Route::delete('/auth/logout', [AuthController::class, 'logout'])->middleware(AuthMiddleware::class);

//Update: 
// - put: Update theo kiểu ghi đè
// - patch: Update dựa vào trường gửi lên