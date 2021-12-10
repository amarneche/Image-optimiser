<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompressFilesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'files'=>'',
            'format'=>[Rule::in(['jpg' ,'png' ,'gif' ,'jpeg' ,'webp','psd' ,'tif' ,'ico'])],
            'quality'=>['min:0' ,'max:100'],
        ];
    }
}
