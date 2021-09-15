<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FileCategory;
use App\Models\FileSubCategory;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
     public function index()
    {
        $files = File::all();
        return view('manageFiles.index', compact('files'));
    }

    public function files($fileCategory, $fileSubCategory, $year = null, Request $request)
    {
        $checkUri = is_numeric(substr($request->path(),-4));
        $uri = $request->path();

        $fileCategoryId = DB::table('file_categories')
        ->where('href', '=', $fileCategory)
        ->get();

        $fileSubCategoryId = DB::table('file_sub_categories')
        ->where('href', '=', $fileSubCategory)
        ->get();

        $files = DB::table('files')
        ->where('file_category_id', '=', $fileCategoryId[0]->id)
        ->where('file_sub_category_id', '=', $fileSubCategoryId[0]->id)
        ->where('year', '=', $year)
        ->orderByRaw('internal_number DESC')
        ->get();

        $years = DB::table('files')
        ->where('file_category_id', '=', $fileCategoryId[0]->id)
        ->where('file_sub_category_id', '=', $fileSubCategoryId[0]->id)
        ->groupBy('year')
        ->orderByRaw('year DESC')
        ->get();

        return view('files', compact('files', 'checkUri', 'years', 'uri'));
    }

    public function years($fileCategory, $fileSubCategory){

    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = FileCategory::all();
        return view('uploadFiles', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'category' => 'required',
            'subCategory' => 'required',
            'year' => 'required',
            'files' => 'required'
        ]);


        foreach($request->file('files') as $file){
            
            $extlessForName = (strlen($file->extension()))+1;

            $name = $file->getClientOriginalName();
            if(substr($name,0,7) == 'Decreto'){
                $internal_type = 'Decreto nº. ';
                $internal_number = substr($name, 13,9);
                $simple_name = substr($name, 25,-($extlessForName));
            }
            elseif(substr($name,0,5) == 'Lei n'){
                $internal_type = 'Lei nº. ';
                $internal_number = substr($name, 9,9);
                $simple_name = substr($name, 21,-($extlessForName));
            }
            elseif(substr($name,0,16) == 'Lei Complementar'){
                $internal_type = 'Lei Complementar nº. ';
                $internal_number = substr($name, 22,9);
                $simple_name = substr($name, 34,-($extlessForName));
            }else{
                return redirect()->route('manageFiles.index')->with('warning', 'Nome do arquivo não corresponde ao padrão do sistema');;
            }

           

            $files = new File();

            $files->name = $name;
            $files->path = 'storage/'.$file->store('uploads/'.$request->year);
            $files->year = $request->year;
            $files->ext = $file->extension();
            $files->internal_number = $internal_number;
            $files->internal_type = $internal_type;
            $files->simple_name = $simple_name;
            $files->file_category_id = $request->category;
            $files->file_sub_category_id = $request->subCategory;

            $files->save();
            unset($files);

        };

        return redirect()->route('manageFiles.index')->with('status', 'Upload realizado com sucesso!');;
    }

    public function ajaxRequest(Request $request)
    {
        $subCategories = FileSubCategory::where('file_category_id', '=', $request->category)->get();
        return $subCategories;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $File
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $File
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {   
        $categories = FileCategory::all();        
        return view ('manageFiles.edit',compact('file','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $File
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
           $validaded = $request->validate([
                'name' => 'required',
                'year' => 'required',
                'category' => 'required',
                'subCategory' => 'required'
            ]);

            File::where(['id'=>$file->id])->update([
                'name' => $request->name,
                'year' => $request->year,
                'file_category_id' => $request->category,
                'file_sub_category_id' => $request->subCategory
            ]);

            return redirect()->route('manageFiles.index')->with('status', 'Arquivo alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $File
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file,$id)
    {   
        $file->destroy($id);
    }
}
