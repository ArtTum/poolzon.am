<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'product_name_am' => 'required',
            'product_name_ru' => 'required',
//            'product_desc_am' => 'required',
//            'product_desc_ru' => 'required',
            'colors' => 'required',
            'product_type_id' => 'required',
            'product_brand_id' => 'required',
            'product_appointment_id' => 'required',
            'product_category_id' => 'required',
//            'product_advantages_am' => 'required',
//            'product_advantages_ru' => 'required',
            'product_code' => 'required',
            'price' => 'required',
//            'meta_desc_ru' => 'required',
//            'meta_desc_am' => 'required',
//            'meta_keywords_ru' => 'required',
//            'meta_keywords_am' => 'required',
//            'meta_title_ru' => 'required',
//            'meta_title_am' => 'required',
            'alias' => 'required',
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
            'product_name_am' => 'Название элемента ',
            'product_name_ru' => 'Название элемента ',
            'product_desc_am' => 'Описание элемента ',
            'product_desc_ru' => 'Описание элемента ',
            'meta_title_am' => 'Мета Title',
            'meta_title_ru' => 'Мета Title',
            'meta_keywords_am' => 'Мета Keys',
            'meta_keywords_ru' => 'Мета Keys',
            'meta_desc_am' => 'Мета Description',
            'product_type_id' => 'Тип',
            'product_brand_id' => 'Бренд',
            'product_appointment_id' => 'Назначения',
            'product_category_id' => 'Категория',
            'colors' => 'Цвета',
            'price' => 'Цена',
            'product_code' => 'Product Code',
            'alias' => 'Псевдоним',
        ];
    }
}
