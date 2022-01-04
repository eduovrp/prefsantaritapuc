<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festivity;
use App\Models\FestivityImages;
use \FileUploader;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FestivityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $festivities = Festivity::orderByRaw('FIELD
        (month, "January","February","March","April","May","June","July","August","September","October","November","December")')
        ->get();

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
        dd($request);


        $validaded = $request->validate([
            'name' => 'required|min:5',
            'month' => 'required',
            'tag' => 'required',
            'local' => 'required'
        ]);

        $fest = new Festivity();

        $fest->name = trim($request->name);
        $fest->tag = trim($request->tag);
        $fest->local = trim($request->local);
        $fest->desc = trim($request->desc);
        $fest->save();

        $folderName = date("Ymdhis")."/";

        $dir = storage_path('app/public/festivities/');
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
        }

        $FileUploader = new FileUploader('files5', array(
            'limit' => 2,
            'uploadDir' => $dir,
            'title' => 'auto'
        ));

        $upload = $FileUploader->upload();

        foreach($upload['files'] as $uploadedFile){
            $fImg = new FestivityImages();

            $fImg->src = Storage::url('festivities/').$uploadedFile['name'];
            $fImg->folderName = $folderName;
            $fImg->fileName = $uploadedFile['name'];;
            $fImg->festivity_id = 1;
            $fImg->save();
        }

        unset($FileUploader);

        // if(isset($request->files4)){

        //     $FileUploader = new FileUploader('files4', array(
        //         'limit' => 1,
        //         'uploadDir' => $dir,
        //         'title' => 'auto'
        //     ));

        //     $upload2 = $FileUploader->upload();
        //     $src_img_onclick = Storage::url('cards/').$upload2['files'][0]['name'];
        //     unset($FileUploader);
        // }else{
        //     $src_img_onclick = null;
        // }

        // return redirect()->route('manageCards.index')->with('status', 'Cartão criado com sucesso!');;
    }




}
