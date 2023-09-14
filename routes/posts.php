<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::group(['controller' => PostController::class, 'middleware' => 'auth'], function () {
    Route::get('/posts', 'index')->name('posts.index');
    Route::get('/post/create', 'create')->name('post.create');
    Route::post('/post/store', 'store')->name('post.store');
});
