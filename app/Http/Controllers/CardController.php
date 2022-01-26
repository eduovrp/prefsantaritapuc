<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use \FileUploader;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::orderBy('id', 'desc')->get();
        return view ('manageCards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manageCards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $folderName = date("Ymdhis")."/";

        $dir = storage_path('app/public/cards/'.$folderName);
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

        $FileUploader = new FileUploader('files3', array(
            'limit' => 1,
            'uploadDir' => $dir,
            'title' => 'auto'
        ));

        $validaded = $request->validate([
            'name' => 'required|min:5',
            'date' => 'required',
            'files3' => 'required'
        ]);

        if(isset($request->active)){
            $active = 1;
        }else{
            $active = 0;
        }

        if(isset($request->href)){
            $href = trim($request->href);
        }else{
            $href = null;
        }

        $upload = $FileUploader->upload();
        FileUploader::resize($filename = $upload['files'][0]['file'], $width = 1360, $height = null, $destination = $dir  . $upload['files'][0]['name'], $crop = false, $quality = 80);
        $src_img = Storage::url('cards/'.$folderName).$upload['files'][0]['name'];
        unset($FileUploader);

        if(isset($request->files4)){

            $dirOnclick = storage_path('app/public/cards/'.$folderName.'onclick/');
            if (!file_exists($dirOnclick)) {
                mkdir($dirOnclick, 0777, true);
            }

            $FileUploader = new FileUploader('files4', array(
                'limit' => 1,
                'uploadDir' => $dirOnclick,
                'title' => 'auto'
            ));

            $upload2 = $FileUploader->upload();
            FileUploader::resize($filename = $upload2['files'][0]['file'], $width = 800, $height = null, $destination = $dirOnclick  . $upload2['files'][0]['name'], $crop = false, $quality = 80);
            $src_img_onclick = Storage::url('cards/'.$folderName.'onclick/').$upload2['files'][0]['name'];
            unset($FileUploader);
        }else{
            $src_img_onclick = null;
        }

        $card = new Card();

        $card->name = trim($request->name);
        $card->date_exp = $request->date;
        $card->active = $active;
        $card->href = $href;
        $card->folderName = $folderName;
        $card->src_img = $src_img;
        $card->src_img_onclick = $src_img_onclick;
        $card->save();

        return redirect()->route('manageCards.index')->with('status', 'Cartão criado com sucesso!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {

        $img = Card::where(['id'=>$card->id])->first();

            if($img->src_img){
                $uploadDir = 'storage/cards/'.$img->folderName;
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
                            "thumbnail" => file_exists('/'.$uploadDir . $file) ? $uploadDir  . $file : null, // (optional)
							"readerForce" => true // (optional) prevent browser cache
						),
					);
				}

				$files = json_encode($preloadedFiles);
                unset($preloadedFiles);
            } else {
                $files = null;
            }

            if($img->src_img_onclick){
                $uploadDir = 'storage/cards/'.$img->folderName.'onclick/';
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
                            "thumbnail" => file_exists('/'.$uploadDir . $file) ? $uploadDir  . $file : null, // (optional)
							"readerForce" => true // (optional) prevent browser cache
						),
					);
				}

				$files_onclick = json_encode($preloadedFiles);
            } else {
                $files_onclick = null;
            }

        return view('manageCards.edit', compact('card', 'files','files_onclick'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $card = Card::first();

        if($request->hasFile('files5')){

            $dir = storage_path('app/public/cards/'.$card->folderName);

            $FileUploader = new FileUploader('files5', array(
                'limit' => 1,
                'uploadDir' => $dir,
                'title' => 'auto'
            ));

            $upload = $FileUploader->upload();

            FileUploader::resize($filename = $upload['files'][0]['file'], $width = 1360, $height = null, $destination = $dir  . $upload['files'][0]['name'], $crop = false, $quality = 90);

            $src_img = Storage::url('cards/'.$card->folderName).$upload['files'][0]['name'];
            unset($FileUploader);
        } else {
            $src_img = $card->src_img;
        }

        if($request->hasFile('files6')){

            $dir = storage_path('app/public/cards/'.$card->folderName.'onclick/');

            $FileUploader = new FileUploader('files6', array(
                'limit' => 1,
                'uploadDir' => $dir,
                'title' => 'auto'
            ));

            $upload = $FileUploader->upload();

            FileUploader::resize($filename = $upload['files'][0]['file'], $width = 800, $height = null, $destination = $dir  . $upload['files'][0]['name'], $crop = false, $quality = 90);

            $src_img_onclick = Storage::url('cards/'.$card->folderName.'onclick/').$upload['files'][0]['name'];
            unset($FileUploader);
        } else {
            $src_img_onclick = $card->src_img_onclick;
        }

        if(isset($request->active)){
            $active = 1;
        }else{
            $active = 0;
        }

        if(isset($request->href)){
            $href = trim($request->href);
        }else{
            $href = null;
        }

        Card::where(['id'=>$card->id])->update([
            'name' => trim($request->name),
            'href' => $href,
            'active' => $active,
            'date_exp' => trim($request->date),
            'src_img' => $src_img,
            'src_img_onclick' => $src_img_onclick
        ]);

        return redirect()->route('manageCards.index')->with('status', 'Cartão alterado com sucesso!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card, $id)
    {
        $card = Card::where('id', $id)->first();

        if($card->folderName)
            Storage::deleteDirectory('cards/'.$card->folderName);

        $card->destroy($id);
    }

     /**
     * Remove the specified image from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function deleteImages( $file)
    {
        $img = Card::where('src_img', 'LIKE', '%'.$file.'%')->first();

        Card::where('id', $img->id)
        ->update(['src_img' => null]);

        if($img->folderName)
            Storage::delete([
                'cards/'.$img->folderName . $file,
            ]);
    }

    public function deleteImagesOnclick( $file)
    {
        $img = Card::where('src_img_onclick', 'LIKE', '%'.$file.'%')->first();

        Card::where('id', $img->id)
        ->update(['src_img_onclick' => null]);

        if($img->folderName)
            Storage::delete([
                'cards/'.$img->folderName .'onclick/'. $file,
            ]);
    }
}
