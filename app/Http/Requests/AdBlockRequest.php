<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdBlockRequest extends FormRequest
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
            'ad_block_name' => [
                'required',
                'string',
                'max:255',
            ],
            'ad_block_code' => [
                'required',
                'string'
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

//            'hs_code.required' => 'A name is required, bro',
//            'email.email' => 'that is not an email address'
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
