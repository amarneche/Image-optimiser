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
        try{
            $response=[];
            $quality=$request->quality;
            $format= $request->format;
            foreach($request->file('files') as $file ){
                $uploadedPath=$file->store('public');
                $filename=explode('.',$file->getClientOriginalName())[0];
                $hash=  explode('.',$file->HashName())[0];
                $originalExtension=$file->getClientOriginalExtension();
                $compressedFile =Image::make(Storage::path($uploadedPath))->save("storage/{$hash}.{$format}",$quality);
                $compressedPath="public/{$compressedFile->basename}";
    
                array_push($response,[
                    'name'=>$filename.".".$format,
                    'hashName'=>$compressedFile->basename,
                    'path'=>$compressedPath,
                    'oldSize'=>$file->getSize(),
                    'newSize'=>Storage::size($compressedPath),
                    'exension'=>$originalExtension,
                ]);
                if($originalExtension != $format)
                    Storage::delete($uploadedPath);
            }
            return response()->json(['response'=>$response]);
        }
        catch(\exception $e){
            report($e);
            return response()->json(['err'=>$e->getMessage()]);
        }

        return redirect('/')->with('response' , $response);
       
    }
    public function download(Request $request){

        if($request->path && $request->filename){
            return Storage::download($request->path,$request->filename) ;
        }
        
    }
}


