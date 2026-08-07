<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TranslateRequest extends FormRequest
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
            'text_am' => [
                'required',
                'string',
                'max:255',
            ],
            'text_ru' => [
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

        ];
    }
}
