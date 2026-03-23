<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'find']);
Route::post('/products', [ProductController::class, 'create']);
Route::patch('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'delete']);

Route::apiResource('photos', PhotoController::class);

//Update: 
// - put: Update theo kiểu ghi đè
// - patch: Update dựa vào trường gửi lên