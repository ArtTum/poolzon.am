<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'url',
        'slider_image',
        'order_number',
        'slider_status'
    ];

    public function getSliderLang(){
        return $this->hasMany(SliderLang::class, 'slider_id', 'id');
    }
}
