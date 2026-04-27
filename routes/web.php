<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// show all posts
Route::get('/posts', [PostController::class, "index"]);

// go to create post form
Route::get('/posts/create', [PostController::class, "create"]);

// save new post entered in form
Route::post('/posts', [PostController::class, "store"]);

// show one post
Route::get('/posts/{post}', [PostController::class, "show"]);

// go to edit form
Route::get('/posts/{post}/edit', [PostController::class, "edit"]);

// save edit
Route::put('/posts/{post}', [PostController::class, "update"]);

// delete 
Route::delete('/posts/{post}', [PostController::class, "destroy"]);

// // can replace all above by this
// Route::resource("/posts", PostController::class);
