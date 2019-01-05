<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StoreProductRequest extends FormRequest
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
            'price' => 'required|numeric|min:0.00|max:100000000.00',
            'main_photo' => 'mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:20000',
            'main_video' => 'mimetypes:video/mp4,video/webm,video/ogg|max:50000',
            'category' => 'integer|nullable',
            'priority' => 'integer|nullable',
            'youtube' => 'max:255',
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
        if ($this->attributes_namesRU != null) {
            foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
            {
                $this->{'attributes_names'.strtoupper($code)} = count($this->{'attributes_names'.strtoupper($code)}) - 1;
                foreach(range(0, $this->{'attributes_names'.strtoupper($code)}) as $index) {
                    $rules['attributes_names'.strtoupper($code).'.'.$index] = 'required|max:255';
                    $rules['attributes_values'.strtoupper($code).'.'.$index] = 'required|max:255';
                }
            }
        }
        return $rules;
    }
}
