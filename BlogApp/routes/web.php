<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', [PostController::class, 'index']);
Route::resource('posts', PostController::class);
Route::resource('comments', CommentController::class)->only(['store']);

Auth::routes();
