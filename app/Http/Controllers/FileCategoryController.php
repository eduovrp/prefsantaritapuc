<?php

namespace App\Http\Controllers;

use App\Models\FileCategory;
use App\Models\FileSubCategory;
use Illuminate\Http\Request;

class FileCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function uploadFiles()
    {
        $categories = FileCategory::all();
        return view ('uploadFiles', compact('categories'));
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
     * @param  \App\Models\FileCategory  $FileCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FileCategory $FileCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileCategory  $FileCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FileCategory $FileCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileCategory  $FileCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileCategory $FileCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileCategory  $FileCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileCategory $FileCategory)
    {
        //
    }
}
