<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorLang extends Model
{
    public $timestamps = false;
    protected $table = 'colors_has_lang';
    protected $fillable = [
        'color_id',
        'lang_id',
        'color_name',
    ];
}
