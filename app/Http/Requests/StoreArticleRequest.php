<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StoreArticleRequest extends FormRequest
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
        $rules = [
            'main_photo' => 'mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:20000',
        ];
        foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
        {
            $rules['title'.strtoupper($code)] = 'required|max:255';
            $rules['short_description'.strtoupper($code)] = 'max:1000';
            $rules['description'.strtoupper($code)] = 'max:65000';
            $rules['titleSEO'.strtoupper($code)] = 'max:255';
            $rules['descriptionSEO'.strtoupper($code)] = 'max:1000';
            $rules['keywordsSEO'.strtoupper($code)] = 'max:255';
        }
        return $rules;
    }
}
