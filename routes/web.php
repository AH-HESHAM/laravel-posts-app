<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

function getPosts() {
    return json_decode(file_get_contents(database_path('posts.json')), true);
}

function savePosts($posts) {
    file_put_contents(database_path('posts.json'), json_encode($posts, JSON_PRETTY_PRINT));
}

// show all posts
Route::get('/posts', function(){
    $posts = getPosts();
    return view('posts.index', ['posts'=>$posts]);
});

// go to create post form
Route::get('/posts/create', function(){
    return view('posts.create');
});

// save new post entered in form
Route::post('/posts', function(Request $request){
    $posts = getPosts();
    $posts[] = [
        'title' => $request->title,
        'content' => $request->content
    ];
    savePosts($posts);
    return redirect('/posts');
});

// show one post
Route::get('/posts/{post}', function($post){
    $posts = getPosts();
    return view('posts.show', ['posts'=>$posts, 'post'=>$post - 1]);
});

// go to edit form
Route::get('/posts/{post}/edit', function($post){
    $posts = getPosts();
    return view('posts.edit', ['post' => $posts[$post - 1], 'id' => $post]);
});

// save edit
Route::put('/posts/{post}', function(Request $request, $post){
    $posts = getPosts();
    $posts[$post - 1] = [
        'title' => $request->title,
        'content' => $request->content
    ];
    savePosts($posts);
    return redirect('/posts');
});

// delete 
Route::delete('/posts/{post}', function($post){
    $posts = getPosts();
    array_splice($posts, $post - 1, 1);
    savePosts($posts);
    return redirect('/posts');
});
