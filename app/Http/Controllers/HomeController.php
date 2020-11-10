<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Post;
use AdinanCenci\Climatempo\Climatempo;

class HomeController extends Controller
{

    public function index()
    {

        $token      = '0767bb1676bdfb6a5a5b0caf82b63d3e';
        $climatempo = new Climatempo($token);
        $locales 	= 3662;
        $id 		= $climatempo->addLocalesToToken($locales);

        $weather    = $climatempo->current($locales);
        $forecast   = $climatempo->fifteenDays($locales);


        $posts = Post::orderBy('id','desc')->take(4)->get();
        $cards = Card::all();
        return view('home', compact('posts','cards','weather','forecast'));
    }
}
