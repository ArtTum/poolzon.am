<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'appointment_name_am' => 'required',
            'appointment_name_ru' => 'required',
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
            'appointment_name_am' => 'Название типа ',
            'appointment_name_ru' => 'Название типа ',
        ];
    }
}
