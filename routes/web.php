<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

Route::get('/', function () {
    return view('welcome');
});
        
Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);