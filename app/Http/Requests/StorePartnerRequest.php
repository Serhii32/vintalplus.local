<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StorePartnerRequest extends FormRequest
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
        }
        return $rules;
    }
}
