<?php

namespace App\Http\Controllers;

use App\Models\FestivityImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FestivityImagesController extends Controller
{
     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FestivityImages  $festivityImages
     * @return \Illuminate\Http\Response
     */
    public function destroy($file)
    {
        $img = FestivityImages::where('fileName', $file)->first();
        $img->destroy($img->id);
        Storage::delete([
            'festivities/'.$img->folderName . $img->fileName,
            'festivities/'.$img->folderName . 'thumbs/'. $img->fileName,
        ]);
    }
}
