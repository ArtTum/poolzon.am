<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'slider_url' => 'required',
            'slider_name_am' => 'required',
            'slider_name_ru' => 'required',
            'slider_desc_am' => 'required',
            'slider_desc_ru' => 'required',
            'slider_button_am' => 'required',
            'slider_button_ru' => 'required',
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
            'slider_name_am' => 'Название элемента ',
            'slider_name_ru' => 'Название элемента ',
            'slider_desc_am' => 'Описание элемента ',
            'slider_desc_ru' => 'Описание элемента ',
            'slider_button_am' => 'Название кнопок ',
            'slider_button_ru' => 'Название кнопок ',
            'slider_url' => 'URL слайдер ',
        ];
    }
}
