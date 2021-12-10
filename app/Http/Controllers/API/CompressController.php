<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompressFilesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Intervention\Image\Facades\Image;

class CompressController extends Controller
{
    public function compress(CompressFilesRequest $request ){
        // get images from request 
        $response =[];
        $quality=$request->quality;
        $format= $request->format;
        
        foreach($request->file('files') as $file ){
            $path=$file->store('public');

            $name=$file->getClientOriginalName();
            $extension=$file->getClientOriginalExtension();
            $image =Image::make(Storage::path($path))->save(Storage::path($path) ,$quality );
            return Storage::download($path ,$name);
           
        }
        return response()->json(['hello'=>'World']);
        


    }
}
