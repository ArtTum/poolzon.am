<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class AddContactRequest extends FormRequest
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

            'contact_person' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'string',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'max:255',
            ],
            'request_text' => [
                'required',
                'string'
            ],
            'robot' => [
                'accepted'
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
            'request_text' => __('messages.Сообщения (на любом языке)'),
            'contact_person' => __('messages.Контактное лицо'),
            'email' => __('messages.Эл. почта'),
            'phone' =>  __('messages.Телефон'),
            'robot' => __('messages.Я не робот')

        ];
    }
}
