<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostController;

Route::get('/', function () {
   $posts = Post::latest()->get(); // fetch all posts from DB, newest first
    return view('pages.home', compact('posts'));
});

Route::get('/posts/create', function () {
    return view('pages.create');
});

Route::post('/posts', 
[PostController::class, 'store'])->name('posts.store');

Route::get('/posts/{id}', 
[PostController::class, 'show'])->name('posts.show');

Route::get('/posts/{id}/edit', 
[PostController::class, 'edit'])->name('posts.edit');

Route::put('/posts/{id}', 
[PostController::class, 'update'])->name('posts.update');

Route::delete('/posts/{id}', 
[PostController::class, 'destroy'])->name('posts.destroy');