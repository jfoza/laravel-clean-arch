<?php

use App\Features\Product\Presentation\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
Route::get('/{uuid}', [ProductController::class, 'show']);
Route::post('/', [ProductController::class, 'insert']);
Route::put('/{uuid}', [ProductController::class, 'update']);
Route::delete('/{uuid}', [ProductController::class, 'delete']);
