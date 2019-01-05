<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StoreSEORequest extends FormRequest
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
        $rules = [];
        
        for($i = 1; $i <= (count($this->request->all())-2)/3; $i++) {
            foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
            {
                $rules['titleSEO'.strtoupper($code).'_'.$i] = 'max:255';
                $rules['descriptionSEO'.strtoupper($code).'_'.$i] = 'max:1000';
                $rules['keywordsSEO'.strtoupper($code).'_'.$i] = 'max:255';
            }
        }
        return $rules;
    }
}
