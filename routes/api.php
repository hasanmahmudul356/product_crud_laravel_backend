<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['api'])->group(function () {
    Route::post('registration', [UserController::class, 'registration']);
    Route::post('login', [UserController::class, 'login']);

    Route::post('general', [GeneralController::class, 'index']);

    Route::get('products', [FrontendController::class, 'products']);
    Route::get('categories', [FrontendController::class, 'categories']);
});

Route::middleware(['jwtAuth'])->prefix('auth')->group(function () {
    Route::post('image_upload', [GeneralController::class, 'imageUpload']);

    Route::post('logout', [UserController::class, 'logout']);
    Route::post('refresh', [UserController::class, 'refresh']);
    Route::post('details', [UserController::class, 'details']);

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});
