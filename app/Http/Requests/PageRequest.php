<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
            'page_name_am' => 'required',
            'page_name_ru' => 'required',
            'page_alias' => 'required',
            'meta_title_am' => 'required',
            'meta_title_ru' => 'required',
            'meta_keywords_am' => 'required',
            'meta_keywords_ru' => 'required',
            'meta_desc_am' => 'required',
            'meta_desc_ru' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'website.regex' => 'Please use the valid URL: http(s)://(www.)domain_name.domain_zone',
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'page_name_am' => 'Название категории ',
            'page_name_ru' => 'Название категории ',
            'page_alias' => 'Псевдоним',
            'meta_title_am' => 'Мета Title',
            'meta_title_ru' => 'Мета Title',
            'meta_keywords_am' => 'Мета Description',
            'meta_keywords_ru' => 'Мета Description',
        ];
    }
}
