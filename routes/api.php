<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['api'])->group(function () {
    Route::post('registration', [UserController::class, 'registration']);
    Route::post('login', [UserController::class, 'login']);

    Route::post('products', [FrontendController::class, 'products']);
    Route::post('categories', [FrontendController::class, 'categories']);
});

Route::middleware(['jwtAuth'])->prefix('auth')->group(function () {
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('refresh', [UserController::class, 'refresh']);
    Route::post('details', [UserController::class, 'details']);

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});
