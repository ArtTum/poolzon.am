<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderLang extends Model
{
    protected $table = 'sliders_has_lang';
    public $timestamps = false;

    protected $fillable = [
        'slider_id',
        'lang_id',
        'slider_name',
        'slider_description',
        'slider_button',
    ];
}
