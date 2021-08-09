<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($fileCategory, $fileSubCategory)
    {

        $fileCategoryId = DB::table('file_categories')
        ->where('href', '=', $fileCategory)
        ->get();

        $fileSubCategoryId = DB::table('file_sub_categories')
        ->where('href', '=', $fileSubCategory)
        ->get();

        $files = DB::table('files')
        ->where('file_category_id', '=', $fileCategoryId[0]->id)
        ->where('file_sub_category_id', '=', $fileSubCategoryId[0]->id)
        ->get();

        return view('files', compact('files'));
    }

    public function files()
    {
        $files = File::all();
        return view('manageFiles', compact('files'));
    }

    public function upload(Request $request){
        
        dd($request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $File
     * @return \Illuminate\Http\Response
     */
    public function show(File $File)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $File
     * @return \Illuminate\Http\Response
     */
    public function edit(File $File)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $File
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $File)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $File
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $File)
    {
        //
    }
}
