<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/index', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::prefix('comment')->group(function () {

    Route::post('/store', [CommentController::class, 'store']);
    Route::post('/update', [CommentController::class, 'update']);
    Route::post('/delete/{id}', [CommentController::class, 'delete']);
    Route::post('/reply/{id}', [CommentController::class, 'reply']);
});

Route::prefix('user')->group(function () {

    Route::post('/store', [UserController::class, 'store']);
    Route::put('/edit/{id}', [UserController::class, 'update'])->where('id', '[0-9]+');
    Route::get('/store-page', [UserController::class, 'storeView']);
    Route::get('/profile/{id}', [UserController::class, 'profile']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::post('/reset', [UserController::class, 'reset']);
    Route::get('/login', [UserController::class, 'login']);
});

Route::prefix('contact')->group(function () {
    Route::get('/contact-page/{id?}', [ChatController::class, 'contact']);
    Route::get('/contact-page', [ChatController::class, 'contact']);
    Route::post('/receive', [ChatController::class, 'receive']);
    Route::post('/broadcast', [ChatController::class, 'broadcast']);
});

Route::prefix('post')->group(function () {

    Route::get('/store-view', [PostController::class, 'storeView']);
    Route::post('/store', [PostController::class, 'store']);
    Route::get('/show-details/{id}', [HomeController::class, 'showDetails']);
    Route::post('/delete/{id}', [PostController::class, 'delete']);
    Route::get('/edit-view/{id}', [PostController::class, 'editView']);
    Route::post('/edit/{id}', [PostController::class, 'edit']);
});
