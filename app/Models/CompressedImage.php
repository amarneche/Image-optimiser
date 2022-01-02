<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompressedImage extends Model
{
    use HasFactory;
    Use Uuid;
    
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $guarded =[];

}
