<?php

namespace App\Http\Controllers;

use App\Models\FileSubCategory;
use Illuminate\Http\Request;

class FileSubCategoryController extends Controller
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

    public function ajaxRequest(Request $request)
    {
        $subCategories = FileSubCategory::where('file_category_id', '=', $request->category)->get();
        return $subCategories;
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
     * @param  \App\Models\FileSubCategory  $FileSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FileSubCategory $FileSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileSubCategory  $FileSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FileSubCategory $FileSubCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileSubCategory  $FileSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileSubCategory $FileSubCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileSubCategory  $FileSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileSubCategory $FileSubCategory)
    {
        //
    }
}
