<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Input;

class StoreAttributeRequest extends FormRequest
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
        $rules =[];

        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
        {
            if (Input::get('name') == 1) {
                $rules['name'.strtoupper($code)] = 'required|max:255';
            } elseif (Input::get('value') == 1) {
                $rules['value'.strtoupper($code)] = 'required|max:255';
            }
        }
        
        return $rules;
    }
}
