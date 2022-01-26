<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festivity;
use App\Models\FestivityImages;
use \FileUploader;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FestivityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $festivities = Festivity::orderByRaw("DATE_FORMAT(month,'%m')")->get();

        return view('festivities', compact('festivities'));
    }

    public function list()
    {
        $festivities = Festivity::orderBy('id', 'desc')->get();
        return view('manageFestivities.index', compact('festivities'));
    }

    public function create()
    {
        return view('manageFestivities.create');
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
            'name' => 'required|min:3',
            'month' => 'required',
            'tag' => 'required',
            'local' => 'required'
        ]);

        $fest = new Festivity();

        $fest->name = trim($request->name);
        $fest->tag = trim($request->tag);
        $fest->local = trim($request->local);
        $fest->desc = trim($request->desc);
        $fest->month = $request->month."-01";
        $fest->save();

        $folderName = date("Ymdhis")."/";

        $dir = storage_path('app/public/festivities/'.$folderName);
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
        }

        $thumbsDir = storage_path('app/public/festivities/'.$folderName.'thumbs/');
        if (!file_exists($thumbsDir)) {
            mkdir($thumbsDir, 0777, true);
        }

        $FileUploader = new FileUploader('files5', array(
            'limit' => 2,
            'uploadDir' => $dir,
            'title' => 'auto'
        ));

        $upload = $FileUploader->upload();


        // if uploaded and success
            if($upload['isSuccess'] && count($upload['files']) > 0) {
                // get uploaded files
                $uploadedFiles = $upload['files'];
                // create thumbnails
                foreach($uploadedFiles as $item) {
                    FileUploader::resize($filename = $item['file'], $width = 1366, $height = null, $destination = $dir  . $item['name'], $crop = false, $quality = 90);
                    FileUploader::resize($filename = $item['file'], $width = 240, $height = 240, $destination = $thumbsDir  . $item['name'], $crop = false, $quality = 80);
                }
            }

        foreach($upload['files'] as $uploadedFile){
            $fImg = new FestivityImages();

            $fImg->src = Storage::url('festivities/'.$folderName).$uploadedFile['name'];
            $fImg->folderName = $folderName;
            $fImg->fileName = $uploadedFile['name'];;
            $fImg->festivity_id = $fest->id;
            $fImg->save();
        }

        unset($FileUploader);

        return redirect()->route('manageFestivities.index')->with('status', 'Festividade criada com sucesso!');;
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Festivity $festivity)
    {

        $validaded = $request->validate([
            'name' => 'required|min:3',
            'month' => 'required',
            'tag' => 'required',
            'local' => 'required'
        ]);

        Festivity::where(['id'=>$festivity->id])->update([
            'name' => trim($request->name),
            'tag' => trim($request->tag),
            'local' => trim($request->local),
            'desc' => trim($request->desc),
            'month' => $request->month."-01"
        ]);



    if($request->hasFile('files5')){

        $imgs = FestivityImages::where(['festivity_id'=>$festivity->id])->first();

        if(!$imgs){
            $folderName = date("Ymdhis")."/";

            $dir = storage_path('app/public/festivities/'.$folderName);
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
            }

            $thumbsDir = storage_path('app/public/festivities/'.$folderName.'thumbs/');
            if (!file_exists($thumbsDir)) {
                mkdir($thumbsDir, 0777, true);
            }
        }else{
            $folderName = $imgs->folderName;
            $dir = storage_path('app/public/festivities/'.$imgs->folderName);
            $thumbsDir = storage_path('app/public/festivities/'.$imgs->folderName.'thumbs/');
        }

        $FileUploader = new FileUploader('files5', array(
            'limit' => 2,
            'uploadDir' => $dir,
            'title' => 'auto'
        ));

        $upload = $FileUploader->upload();

         // if uploaded and success
            if($upload['isSuccess'] && count($upload['files']) > 0) {
                // get uploaded files
                $uploadedFiles = $upload['files'];
                // create thumbnails
                foreach($uploadedFiles as $item) {
                    FileUploader::resize($filename = $item['file'], $width = 1366, $height = null, $destination = $dir  . $item['name'], $crop = false, $quality = 90);
                    FileUploader::resize($filename = $item['file'], $width = 240, $height = 240, $destination = $thumbsDir  . $item['name'], $crop = false, $quality = 80);
                }
            }

            foreach($upload['files'] as $uploadedFile){
                $fImg = new FestivityImages();

                $fImg->src = Storage::url('festivities/'.$folderName).$uploadedFile['name'];
                $fImg->folderName = $folderName;
                $fImg->fileName = $uploadedFile['name'];;
                $fImg->festivity_id = $festivity->id;
                $fImg->save();
            }

            unset($FileUploader);
        }

        return redirect()->route('manageFestivities.index')->with('status', 'Festividade alterada com sucesso!');;
    }

    public function edit(Festivity $festivity)
    {

        $img = FestivityImages::where(['festivity_id'=>$festivity->id])->first();

            if($img){
                $uploadDir = 'storage/festivities/'.$img->folderName;
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

        return view('manageFestivities.edit',compact('festivity', 'files'));
    }


      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Festivity  $festivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Festivity $festivity, $id)
    {
        $imgs = FestivityImages::where('festivity_id', $id)->get();

        foreach($imgs as $img){

            if($img->folderName)
            Storage::deleteDirectory('festivities/'.$img->folderName);

            $img->destroy($img->id);
        }

       $festivity->destroy($id);
    }




}
