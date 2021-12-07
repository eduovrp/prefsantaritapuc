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
            $href = $request->href;
        }else{
            $href = null;
        }

        $dir = storage_path('app/public/cards/');
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

        $FileUploader = new FileUploader('files3', array(
            'limit' => 1,
            'uploadDir' => $dir,
            'title' => 'auto'
        ));

        $upload = $FileUploader->upload();
        $src_img = Storage::url('cards/').$upload['files'][0]['name'];
        unset($FileUploader);

        if(isset($request->files4)){
            
            $FileUploader = new FileUploader('files4', array(
                'limit' => 1,
                'uploadDir' => $dir,
                'title' => 'auto'
            ));

            $upload2 = $FileUploader->upload();
            $src_img_onclick = Storage::url('cards/').$upload2['files'][0]['name'];
            unset($FileUploader);
        }else{
            $src_img_onclick = null;
        }

        $card = new Card();

        $card->name = trim($request->name);
        $card->date_exp = $request->date;
        $card->active = $active;
        $card->href = $href;
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
        $img_name  = Str::afterLast($card->src_img, '/');
        $img_onclick_name = Str::afterLast($card->src_img_onclick, '/');
        return view('manageCards.edit', compact('card', 'img_name','img_onclick_name'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card, $id)
    {
        $post->destroy($id);
    }
}
