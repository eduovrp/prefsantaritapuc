<?php

namespace App\Http\Controllers;

use App\Models\FileCategory;
use App\Models\FileSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        if(Auth::user()->nivel_acesso_id == "1"){
            $fileCat = new FileCategory();
            $fileCat->name = trim($request->name);
            $fileCat->iconMenu = trim($request->iconMenu);
            $fileCat->href = trim($request->href);
            $fileCat->save();

            return redirect()->route('manageFileCategories.index')->with('status', 'Categoria criada com sucesso!');
        } else{
            return redirect()->route('home')->with('warning', 'Você não possui permissão para acessar esta página');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileCategory  $FileCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FileCategory $FileCategory)
    {
        if(Auth::user()->nivel_acesso_id == "1"){
            $FileCategories = FileCategory::all();
            return view('manageFileCategories.index', compact('FileCategories'));
        } else{
            return redirect()->route('home')->with('warning', 'Você não possui permissão para acessar esta página');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileCategory  $FileCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FileCategory $fileCategory)
    {
        if(Auth::user()->nivel_acesso_id == "1"){
            $cat = FileCategory::where(['id'=>$fileCategory->id])->first();
            $subCategorias = FileSubCategory::where(['file_category_id'=>$fileCategory->id])->get();
            return view('manageFileCategories.edit',compact('cat', 'subCategorias'));
        } else{
            return redirect()->route('home')->with('warning', 'Você não possui permissão para acessar esta página');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileCategory  $FileCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileCategory $fileCategory)
    {
        if(Auth::user()->nivel_acesso_id == "1"){
            FileCategory::where(['id'=>$fileCategory->id])->update([
                'name' => trim($request->name),
                'href' => trim($request->href),
                'iconMenu' => trim($request->iconMenu),
            ]);

            return redirect()->route('manageFileCategories.index')->with('status', 'Categoria alterada com sucesso!');
        } else{
            return redirect()->route('home')->with('warning', 'Você não possui permissão para acessar esta página');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileCategory  $FileCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, FileCategory $FileCategory)
    {
        if(Auth::user()->nivel_acesso_id == "1"){
            $FileCategory->destroy($id);
        } else{
            return redirect()->route('home')->with('warning', 'Você não possui permissão para acessar esta página');
        }
    }
}
