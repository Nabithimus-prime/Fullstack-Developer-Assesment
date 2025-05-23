<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = [
        [
            'id' => 1,
            'title' => 'First Post',
            'excerpt' => 'This is the first post excerpt.',
            'image' => 'images/jjk.jpg'
        ],
        [
             'id' => 2,
            'title' => 'Second Post',
            'excerpt' => 'This is the second post excerpt.',
            'image' => 'images/AOT.jpg'
        ]
    ];

    return view('pages.home', compact('posts'));
});

Route::get('/posts/create', function () {
    return view('pages.create');
});

Route::get('/posts/{id}', function ($id) {
    return view('pages.show', compact('id'));
});