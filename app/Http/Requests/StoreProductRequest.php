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
        dd($this->request);
        $rules = [
            'title' => 'required|max:255',
            'price' => 'required|numeric|min:0.00|max:100000000.00',
            'main_photo' => 'mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:20000',
            'category' => 'integer|nullable',
            'promo_action' => 'integer|min:0|max:1',
            'best' => 'integer|min:0|max:1',
            'novelty' => 'integer|min:0|max:1',
            'description' => 'max:65000',
            'short_description' => 'max:1000',
            'titleSEO' => 'max:255',
            'descriptionSEO' => 'max:1000',
            'keywordsSEO' => 'max:255',
        ];

        // foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
        // {
        //     $rules['title'.strtoupper($code)] = 'required|max:255';
        //     $rules['short_description'.strtoupper($code)] = 'max:1000';
        //     $rules['titleSEO'.strtoupper($code)] = 'max:255';
        //     $rules['descriptionSEO'.strtoupper($code)] = 'max:1000';
        //     $rules['keywordsSEO'.strtoupper($code)] = 'max:255';
        // }

        if ($this->attributes_namesRU != null) {
            foreach(LaravelLocalization::getLocalesOrder() as $code => $locale)
            {
                $attributes_{'names'.strtoupper($code)} = count($this->attributes_{'names'.strtoupper($code)}) - 1;
                foreach(range(0, $attributes_{'names'.strtoupper($code)}) as $index) {
                    $rules['attributes_names_'.strtoupper($code) . '.' . $index] = 'required|max:255';
                    $rules['attributes_values_'.strtoupper($code) . '.' . $index] = 'required|max:255';
                }
            }
        }

        return $rules;
    }
}
