<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/image/preview', [FrontendController::class, 'imagePreview'])->name('image_view');
Route::get('/', function (){
    return view('welcome');
});
