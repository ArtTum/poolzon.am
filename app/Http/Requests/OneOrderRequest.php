<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class OneOrderRequest extends FormRequest
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
        App::setLocale($this->route('lang'));
        return [
            'email' => [
                'required',
                'string',
                'max:255',
                'email'
            ],
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'max:255',
            ],
            'p_first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'p_last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'p_phone' => [
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
            'email' =>  __('messages.Емайл *'),
            'first_name' =>  __('messages.Имя *'),
            'last_name' =>  __('messages.Фамилия *'),
            'phone' =>  __('messages.Телефон *'),
            'p_first_name' =>  __('messages.Имя *'),
            'p_last_name' =>  __('messages.Фамилия *'),
            'p_phone' =>  __('messages.Телефон *'),
        ];
    }
}
