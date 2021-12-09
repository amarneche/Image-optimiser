<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompressFilesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChainFactory;


class CompressController extends Controller
{
    public function compress(CompressFilesRequest $request ){
        // get images from request 

        $optimizerChain = OptimizerChainFactory::create();
        $response =[];
        foreach($request->file('files') as $file ){
            //upload images to server 
           $path= $file->store('public');
           $response['old_path']=$path;

           $output=$optimizerChain->optimize(storage_path($path));
           $response['output_path']=$output;


        }
        return $response;
        


    }
}
