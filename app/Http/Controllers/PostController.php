<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Tag;
use \FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            'text' => 'required|min:5',
            'files1' => 'required'
        ]);

        $category = CategoryPost::where('name', '=', $request->category)->firstOrCreate(
            ['name' => $request->category]
        );


        $dir = storage_path('app/public/notices/');
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

        $FileUploader = new FileUploader('files1', array(
            'limit' => 1,
            'uploadDir' => $dir,
            'title' => 'auto'
        ));

        $upload = $FileUploader->upload();

        $post = new Post();

        $post->title = trim($request->title);
        $post->text = $request->text;
        $post->date = $request->date;
        $post->category_post_id = $category->id;
        $post->src_img = Storage::url('notices/').$upload['files'][0]['name'];

        $post->save();



        foreach(explode(",", $request->tags) as $tagName){
            $tags = new Tag();
            $tags->name = $tagName;
            $tags->post_id = $post->id;
            $tags->save();
            unset($tags);
        }

        unset($post);


    return redirect()->route('managePosts.index')->with('status', 'Notícia criada com sucesso!');;
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
        $img_name  = Str::afterLast($post->src_img, '/');
        $categories = CategoryPost::all();
        $categoriesJson = $categories->toArray();
        return view('managePosts.edit', compact('post', 'categoriesJson', 'img_name'));
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

        $validaded = $request->validate([
            'title' => 'required|min:5',
            'category' => 'required',
            'tags' => 'required',
            'date' => 'required',
            'text' => 'required|min:5',
        ]);

        $category = CategoryPost::where('name', '=', $request->category)->firstOrCreate(
            ['name' => $request->category]
        );

        Tag::where('post_id', $post->id)->delete();

        foreach(explode(",", $request->tags) as $tagName){
            Tag::create(
                [
                    'name' => trim($tagName),
                    'post_id' => $post->id
                ]
            );
        }

        if($request->hasFile('files2')){

            $dir = storage_path('app/public/notices/');

            $FileUploader = new FileUploader('files2', array(
                'limit' => 1,
                'uploadDir' => $dir,
                'title' => 'auto'
            ));

            $upload = $FileUploader->upload();

            Post::where(['id'=>$post->id])->update([
                'src_img' => Storage::url('notices/').$upload['files'][0]['name']]);
        }


        Post::where(['id'=>$post->id])->update([
            'title' => trim($request->title),
            'text' => $request->text,
            'date' => $request->date,
            'category_post_id' => $category->id,
        ]);

        return redirect()->route('managePosts.index')->with('status', 'Notícia alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $id)
    {
        Tag::where('post_id', $id)->delete();
        $post->destroy($id);
    }
}
