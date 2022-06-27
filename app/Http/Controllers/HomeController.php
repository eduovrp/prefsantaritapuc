<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Post;
use AdinanCenci\Climatempo\Climatempo;
use Exception;

class HomeController extends Controller
{

    public function index()
    {

        $token      = '240c46429bacc1c7124574c7b4300934';
        $locales 	= 3662;
        $climatempo = new Climatempo($token);

        try {
            $weather    = $climatempo->current($locales);
        } catch (Exception $e) {
            $weather = null;
        }

        try {
            $forecast   = $climatempo->fifteenDays($locales);
        } catch (Exception $e) {
            $forecast = null;
        }

        $posts = Post::orderBy('id','desc')->take(4)->get();
        $cards = Card::all();
        return view('home', compact('posts','cards','weather','forecast'));
    }
}
