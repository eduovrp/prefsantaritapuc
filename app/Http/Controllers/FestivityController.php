<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festivity;

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


}
