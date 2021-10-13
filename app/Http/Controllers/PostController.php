<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(5);
        return view('posts', compact('posts'));
    }

    public function list()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view ('managePosts.index', compact('posts'));
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryPost::all();
        $categoriesJson = $categories->toArray();
        return view('managePosts.create', compact('categories', 'categoriesJson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validaded = $request->validate([
            'title' => 'required|min:5',
            'category' => 'required',
            'tags' => 'required',
            'date' => 'required',
            'fileuploader-list-files' => 'required',
            'text' => 'required|min:5'
        ]);

        $category = CategoryPost::where('name', '=', $request->category)->firstOrCreate(
            ['name' => $request->category]            
        );

        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $id)
    {
        $post->destroy($id);
    }
}
