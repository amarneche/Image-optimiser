<?php
namespace App\Traits;
use Illuminate\Support\Str;
trait Uuid{
    protected $primaryKey="id";

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            if(empty($model->id)) {
                try{
                    $model->{$model->getKeyName()}= (string) Str::uuid();
                }  
                catch(\Exception $ex){
                    
                }              
                
            }
        });

    }
}