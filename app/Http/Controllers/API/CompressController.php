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
        foreach($request->file('files') as $file ){
            
            $image= Image::make($file)->heighten(600)->save();
            array_push($response,$image);
        }
        return $response;
        


    }
}
