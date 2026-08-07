<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuickSearchRequest extends FormRequest
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
            'quick_search_name_am' => [
                'required',
                'string',
                'max:255',
            ],
            'quick_search_name_ru' => [
                'required',
                'string',
                'max:255',
            ],
            'quick_search_name_en' => [
                'required',
                'string',
                'max:255',
            ],
            'quick_search_alias_am' => [
                'required',
                'string',
                'max:255',
            ],
            'quick_search_alias_ru' => [
                'required',
                'string',
                'max:255',
            ],
            'quick_search_alias_en' => [
                'required',
                'string',
                'max:255',
            ],
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
            'ad_block_name' => 'Название блока',
            'ad_block_code' => 'Код блока',
        ];
    }
}
