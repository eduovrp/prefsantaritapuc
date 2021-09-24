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
        ->first();

        $fileSubCategoryId = DB::table('file_sub_categories')
        ->where('href', '=', $fileSubCategory)
        ->first();

        $files = DB::table('files')
        ->join('file_sub_categories', 'files.file_sub_category_id', '=', 'file_sub_categories.id')
        ->select('files.name as fileName', 'files.path as path', 
        'files.ext as ext' , 'files.desc as desc' , 'files.number as number' , 'files.year as year',
        'file_sub_categories.single_name as single_name')
        ->where('files.file_category_id', '=', $fileCategoryId->id)
        ->where('file_sub_category_id', '=', $fileSubCategoryId->id)
        ->where('year', '=', $year)
        ->orderByRaw('number DESC')
        ->get();

        $years = DB::table('files')
        ->where('file_category_id', '=', $fileCategoryId->id)
        ->where('file_sub_category_id', '=', $fileSubCategoryId->id)
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
            
            //Conta a quantidade de caracteres da extenção e adiciona 1 a contagem para o caractere '.'
            $extlessForName = (strlen($file->extension()))+1;

            //Remove espaços no começo e no final com trim
            //Ajusta Espaços duplos com str_replace
            //Retira a extensão do arquivo com substr
            $name = trim(
                str_replace(
                    '  ', ' ',
                    substr(
                        $file->getClientOriginalName(), 0,-($extlessForName)
                    )
                )
            );

            if(substr($name,0,7) == 'Decreto'){
                $number = substr($name, 13,4);
                $desc = substr($name, 25);
            }
            elseif(substr($name,0,5) == 'Lei n'){
                $number = substr($name, 9,4);
                $desc = substr($name, 21);
            }
            elseif(substr($name,0,16) == 'Lei Complementar'){
                $number = substr($name, 22,4);
                $desc = substr($name, 34);
            } else{
                $number = "";
                $desc = "";
            }

           

            $files = new File();

            $files->name = $name;
            $files->path = 'storage/'.$file->store('uploads/'.$request->year);
            $files->year = $request->year;
            $files->ext = $file->extension();
            $files->number = $number;
            $files->desc = $desc;
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
        return view('manageFiles.edit',compact('file','categories'));
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
                'desc' => 'required',
                'year' => 'required',
                'category' => 'required',
                'subCategory' => 'required'
            ]);

            $name = $file->fileSubCategory->single_name.' n°. '.$request->number.'-'.$request->year.' - '.$request->desc;

            File::where(['id'=>$file->id])->update([
                'name' => $name,
                'desc' => $request->desc,
                'year' => $request->year,
                'number' => $request->number,
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
