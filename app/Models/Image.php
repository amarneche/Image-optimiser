<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Intervention\Image\Facades\Image as Compressor;
class Image extends Model
{
    use HasFactory;
    Use Uuid;
   
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $guarded =[];


    public function compressedFiles(){
        return $this->hasMany(CompressedImage::class);
    }

    public function compress($path , $format , $quality){
        
      $path=  Compressor::make($path)->save($path,$format,$quality);

    }
    
}
