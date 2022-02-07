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

        $folderName = date("Ymdhis")."/";

        $dir = storage_path('app/public/notices/'.$folderName);
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $thumbsDir = storage_path('app/public/notices/'.$folderName.'thumbs/');
            if (!file_exists($thumbsDir)) {
                mkdir($thumbsDir, 0777, true);
            }

        $FileUploader = new FileUploader('files1', array(
            'limit' => 1,
            'uploadDir' => $dir,
            'title' => 'auto'
        ));

        $upload = $FileUploader->upload();

        if($upload['isSuccess'] && count($upload['files']) > 0) {
            // get uploaded files
            $uploadedFiles = $upload['files'];
            // create thumbnails
            foreach($uploadedFiles as $item) {
                FileUploader::resize($filename = $item['file'], $width = null, $height = 580, $destination = $dir  . $item['name'], $crop = true, $quality = 90);
                FileUploader::resize($filename = $item['file'], $width = 300, $height = null, $destination = $thumbsDir  . $item['name'], $crop = false, $quality = 80);
            }
        }

        $post = new Post();

        $post->title = trim($request->title);
        $post->text = $request->text;
        $post->date = $request->date;
        $post->folderName = $folderName;
        $post->category_post_id = $category->id;
        $post->src_img = Storage::url('notices/'.$folderName).$upload['files'][0]['name'];

        $post->save();



        foreach(explode(",", $request->tags) as $tagName){
            $tags = new Tag();
            $tags->name = $tagName;
            $tags->post_id = $post->id;
            $tags->save();
            unset($tags);
        }

        unset($post);


    return redirect()->route('managePosts.index')->with('status', 'Notícia criada com sucesso!');
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
        $post = Post::where(['id'=>$post->id])->first();

        if($post){
            $uploadDir = 'storage/notices/'.$post->folderName;
            $preloadedFiles = array();
            $uploadsFiles = array_diff(scandir($uploadDir), array('.', '..'));

            foreach($uploadsFiles as $file) {
                if(is_dir($uploadDir . $file))
                    continue;

                $preloadedFiles[] = array(
                    "name" => $file,
                    "type" => FileUploader::mime_content_type($uploadDir . $file),
                    "size" => filesize($uploadDir . $file),
                    "file" => '/'.$uploadDir . $file,
                    "local" => $uploadDir . $file, // same as in form_upload.php
                    "data" => array(
                        "url" => $uploadDir . $file, // (optional)
                        "thumbnail" => file_exists('/'.$uploadDir . 'thumbs/' . $file) ? $uploadDir . 'thumbs/' . $file : null, // (optional)
                        "readerForce" => true // (optional) prevent browser cache
                    ),
                );
            }

            $files = json_encode($preloadedFiles);
        } else {
            $files = null;
        }

        $categories = CategoryPost::all();
        $categoriesJson = $categories->toArray();

        return view('managePosts.edit', compact('post', 'categoriesJson', 'files'));
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

            $post = Post::where('id', $post->id)->first();

            $dir = storage_path('app/public/notices/'.$post->folderName);
            $thumbsDir = storage_path('app/public/notices/'.$post->folderName.'thumbs/');

            $FileUploader = new FileUploader('files2', array(
                'limit' => 1,
                'uploadDir' => $dir,
                'title' => 'auto'
            ));

            $upload = $FileUploader->upload();

            if($upload['isSuccess'] && count($upload['files']) > 0) {
                // get uploaded files
                $uploadedFiles = $upload['files'];
                // create thumbnails
                foreach($uploadedFiles as $item) {
                    FileUploader::resize($filename = $item['file'], $width = null, $height = 600, $destination = $dir  . $item['name'], $crop = true, $quality = 90);
                    FileUploader::resize($filename = $item['file'], $width = 300, $height = null, $destination = $thumbsDir  . $item['name'], $crop = false, $quality = 80);
                }
            }

            Post::where(['id'=>$post->id])->update([
                'src_img' => Storage::url('notices/'.$post->folderName).$upload['files'][0]['name']]);
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
     * Remove the specified image from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function deleteImages( $file)
    {
        $img = Post::where('src_img', 'LIKE', '%'.$file.'%')->first();

        Post::where('id', $img->id)
        ->update(['src_img' => null]);

        if($img->folderName)
            Storage::delete([
                'notices/'.$img->folderName . $file,
                'notices/'.$img->folderName . 'thumbs/'. $file,
            ]);
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

        $post = Post::where('id', $id)->first();

        if($post->folderName)
            Storage::deleteDirectory('notices/'.$post->folderName);

        $post->destroy($id);

    }
}
