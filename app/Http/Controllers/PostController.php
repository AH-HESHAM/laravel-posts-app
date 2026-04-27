<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    function getPosts() {
        return json_decode(file_get_contents(database_path('posts.json')), true);
    }

    function savePosts($posts) {
        file_put_contents(database_path('posts.json'), json_encode($posts, JSON_PRETTY_PRINT));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->getPosts();
        return view('posts.index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $posts = $this->getPosts();
        $posts[] = [
            'title' => $request->title,
            'content' => $request->content
        ];
        $this->savePosts($posts);
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts = $this->getPosts();
        return view('posts.show', ['posts'=>$posts, 'post'=>$id - 1]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posts = $this->getPosts();
        return view('posts.edit', ['post' => $posts[$id - 1], 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $posts = $this->getPosts();
        $posts[$id - 1] = [
            'title' => $request->title,
            'content' => $request->content
        ];
        $this->savePosts($posts);
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posts = $this->getPosts();
        array_splice($posts, $id - 1, 1);
        $this->savePosts($posts);
        return redirect('/posts');
    }
}
